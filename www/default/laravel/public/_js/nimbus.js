(function(window,THREE){
    function rndi(min,max){
        return Math.floor(Math.random()*(max-min+1)+min);
    }
    var nbs={
        settings:{

        },
        data:[
            {type:'sun',class:'default',size:100,position:[0,0,0]},
            {type:'sun',class:'default',size:15,position:[-120,120,120]},
            {type:'sun',class:'default',size:100,position:[-500,0,200]},
        ]
    };
    nbs.data=[];
    for(var i= 0;i<400;i++){
        var o={type:'sun',class:'default',size:10,position:[rndi(-1000,1000),rndi(-1000,1000),rndi(-1000,1000)]};
        nbs.data.push(o);
    }
    var nbsObjects={
        sun:function(data){
            var mesh=new THREE.Mesh(
                new THREE.SphereGeometry(data.size,data.size*2,data.size*2),
                new THREE.MeshLambertMaterial({color:0xffffff})
            );
            mesh.position.set(data.position[0],data.position[1],data.position[2]);
            return mesh;
        }
        ,grid:function(size,step){
            var geometry = new THREE.Geometry();
            var material = new THREE.LineBasicMaterial({color: 0x222222});
            for (var i = - size; i <= size; i += step){
                geometry.vertices.push(new THREE.Vector3( - size, - 0.04, i ));
                geometry.vertices.push(new THREE.Vector3( size, - 0.04, i ));
                geometry.vertices.push(new THREE.Vector3( i, - 0.04, - size ));
                geometry.vertices.push(new THREE.Vector3( i, - 0.04, size ));
            }
            return new THREE.Line(geometry,material,THREE.LinePieces);
        }
    };
    var nbsMap=function(host,uni,render_options){
        this.uni=uni;
        this.objects=[];
        // Init three
        this.scene=new THREE.Scene();
        this.scene.fog = new THREE.Fog( 0x000000, 0.002,5000 );
        this.camera=new THREE.PerspectiveCamera(75,window.innerWidth/window.innerHeight,1,10000);
        // Set initial position
        this.camera.position.set( 270, 270, 1000 );
        // Controls and settings
        this.controls = new THREE.OrbitControls(this.camera);
        this.controls.maxDistance=1500;
        this.controls.enableDamping=true;
        this.controls.rotateSpeed=0.2;
        // Clock
        this.clock = new THREE.Clock();
        // Projector
        this.projector = new THREE.Projector();
        // Selected renderer
        this.renderer=new THREE[(this.webglAvailable()?'WebGLRenderer':'CanvasRenderer')](render_options);
        this.renderer.setClearColor(this.scene.fog.color);
        this.renderer.shadowMap.enabled = true;
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        // Set init size
        this.renderer.setSize(window.innerWidth,window.innerHeight);
        // Append to dom
        document.getElementById(host).appendChild(this.renderer.domElement);

        this.init();
        this.render();
    };
        nbsMap.prototype.webglAvailable=function(){
            try{
                var canvas=document.createElement('canvas');
                return !!(window.WebGLRenderingContext&&(canvas.getContext('webgl')||canvas.getContext('experimental-webgl')));
            }catch(e){return false;}
        };
        nbsMap.prototype.init=function(){

            this.addObject(nbsObjects.grid(8000,200),false,false);

            for(var i in nbs.data){
                this.addObject(nbsObjects[nbs.data[i].type](nbs.data[i]));
            }

            /*light = new THREE.DirectionalLight(0xcccc00);
            light.position.set(1000,0,0);
            this.scene.add(light);*/

            light = new THREE.DirectionalLight(0x00cccc);
            light.position.set(-500,500,500);
            light.castShadow = true;
            light.shadowDarkness = 0.5;

            this.scene.add(light);

            light = new THREE.AmbientLight(0x666666);
            this.scene.add(light);

        };
        nbsMap.prototype.addObject=function(obj,castShadow,receiveShadow){
            if(castShadow!==false){castShadow=true;}
            obj.castShadow = castShadow;
            if(receiveShadow!==false){receiveShadow=true;}
            obj.receiveShadow = receiveShadow;

            this.objects.push(obj);
            this.scene.add(obj);
        };
        nbsMap.prototype.addTween=function(){};
        nbsMap.prototype.render=function(){
            var _map=this;
            var render=function(){
                requestAnimationFrame(render);

                _map.scene.updateMatrixWorld();

                TWEEN.update();
                _map.controls.update();
                _map.renderer.render(_map.scene,_map.camera);
            };

            var onWindowResize=function(){
                _map.camera.aspect = window.innerWidth / window.innerHeight;
                _map.camera.updateProjectionMatrix();
                _map.renderer.setSize( window.innerWidth, window.innerHeight );
            };
            window.addEventListener( 'resize', onWindowResize, false );

            var onDocumentMouseDown=function ( event ) {
                var mouse3D = new THREE.Vector3( ( event.clientX / window.innerWidth ) * 2 - 1, //x
                    -( event.clientY / window.innerHeight ) * 2 + 1, //y
                    0.5 ); //z
                var raycaster = new THREE.Raycaster();
                    raycaster.setFromCamera( mouse3D.clone(), _map.camera );

                var intersects = raycaster.intersectObjects( _map.objects );
                // Change color if hit block
                if ( intersects.length > 0 ) {
                    var selectedObject=intersects[ 0 ].object;
                        selectedObject.material.color.setHex( Math.random() * 0xffffff );

                    var tween = new TWEEN.Tween(_map.controls.target).to(selectedObject.position,800)
                        .easing(TWEEN.Easing.Sinusoidal.InOut).onUpdate(function () {
                    }).onComplete(function () {
                        _map.controls.target.set(selectedObject.position.x,selectedObject.position.y,selectedObject.position.z);
                    }).start();

                    var tween = new TWEEN.Tween(_map.controls.center).to(selectedObject.position,800)
                        .easing(TWEEN.Easing.Sinusoidal.InOut).onUpdate(function () {
                    }).onComplete(function () {
                        _map.controls.center.set(selectedObject.position.x,selectedObject.position.y,selectedObject.position.z);
                    }).start();
                }
            };
            document.addEventListener( 'mousedown', onDocumentMouseDown, false );

            render();
        };

    window['nimbus']=new (function(){
        this.init=function(what,data){
            console.log(what);
            console.log(data);
            switch(what){
                case 'map':
                    console.log('map:init');
                    this.map=new nbsMap('nbsTHREEmap',data.uni,{
                        antialias:true
                    });
                break;
                case 'game':
                    console.log('game:init');
                break;
                default:
                    throw 'nimbus.init(['+what+']invalid);';
            }
        };
    });
})(window,THREE);


/*

var container, stats;

var camera, controls, scene, renderer;

var cross;

init();
animate();

function init() {

    camera = new THREE.PerspectiveCamera( 60, window.innerWidth / window.innerHeight, 1, 1000 );
    camera.position.z = 500;

    controls = new THREE.OrbitControls( camera );
    controls.addEventListener( 'change', render );

    scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2( 0xcccccc, 0.002 );

    // world

    var geometry = new THREE.CylinderGeometry( 0, 10, 30, 4, 1 );
    var material = new THREE.MeshLambertMaterial( { color:0xffffff, shading: THREE.FlatShading } );

    for ( var i = 0; i < 500; i ++ ) {

        var mesh = new THREE.Mesh( geometry, material );
        mesh.position.x = ( Math.random() - 0.5 ) * 1000;
        mesh.position.y = ( Math.random() - 0.5 ) * 1000;
        mesh.position.z = ( Math.random() - 0.5 ) * 1000;
        mesh.updateMatrix();
        mesh.matrixAutoUpdate = false;
        scene.add( mesh );

    }


    // lights

    light = new THREE.DirectionalLight( 0xffffff );
    light.position.set( 1, 1, 1 );
    scene.add( light );

    light = new THREE.DirectionalLight( 0x002288 );
    light.position.set( -1, -1, -1 );
    scene.add( light );

    light = new THREE.AmbientLight( 0x222222 );
    scene.add( light );


    // renderer

    renderer = new THREE.WebGLRenderer( { antialias: false } );
    renderer.setClearColor( scene.fog.color, 1 );
    renderer.setSize( window.innerWidth, window.innerHeight );

    container = document.getElementById( 'container' );
    container.appendChild( renderer.domElement );

    window.addEventListener( 'resize', onWindowResize, false );

}

function onWindowResize() {

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize( window.innerWidth, window.innerHeight );

    render();

}

function animate() {

    requestAnimationFrame( animate );
    controls.update();

}

function render() {
    renderer.render( scene, camera );
}

*/



/*

<!DOCTYPE html>
<html lang="en">
<head>
<body>
<script src="/Scripts/conc/three.js">
<script>
var container;
var camera, scene, projector, renderer;
var particleMaterial;
var viewWidth = window.innerWidth;
var viewHeight = window.innerHeight;
var cameraOffset = window.innerWidth;
var objects = [];
init();
function init() {
    container = document.createElement( 'div' );
    document.body.appendChild( container );
    camera = new THREE.PerspectiveCamera( 70, window.innerWidth / window.innerHeight, 1, 10000 );
    camera.position.set( 0, 0, cameraOffset );
    scene = new THREE.Scene();
    var geometry = new THREE.BoxGeometry( 100, 100, 100 );
    var object = new THREE.Mesh( geometry, new THREE.MeshBasicMaterial( { color: 0x0000ff, opacity: 0.5 } ) );
    object.position.x = 0;
    object.position.y = 0;
    object.position.z = 0;
    object.scale.x = 1;
    object.scale.y = 1;
    object.scale.z = 1;
    object.rotation.x = Math.PI / 4;
    object.rotation.y = Math.PI / 4;
    object.rotation.z = Math.PI / 4;
    scene.add( object );
    objects.push( object );
    var PI2 = Math.PI * 2;
    particleMaterial = new THREE.SpriteCanvasMaterial( {
        color: 0x000000,
        program: function ( context ) {
            context.beginPath();
            context.arc( 0, 0, 0.5, 0, PI2, true );
            context.fill();
        }
    } );
    projector = new THREE.Projector();
    renderer = new THREE.CanvasRenderer();
    renderer.setClearColor( 0xf0f0f0 );
    renderer.setSize( viewWidth, viewHeight );
    container.appendChild( renderer.domElement );
    document.addEventListener( 'mousedown', onDocumentMouseDown, false );
    window.addEventListener( 'resize', onWindowResize, false );
    camera.lookAt(new THREE.Vector3(0,0,0));
    render();
}
function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize( window.innerWidth, window.innerHeight );
    render();
}
function addNewParticle(pos, scale)
{
    if( !scale )
    {
        scale = 16;
    }
    var particle = new THREE.Sprite( particleMaterial );
    particle.position = pos;
    particle.scale.x = particle.scale.y = scale;
    scene.add( particle );
}
function drawLine(pointA, pointB, lineColor)
{
    var material = new THREE.LineBasicMaterial({
        color: lineColor
    });
    var geometry = new THREE.Geometry();
    var max = 500*500;
    if( Math.abs(pointA.x - pointB.x) < max && Math.abs(pointA.y - pointB.y) < max && Math.abs(pointA.z - pointB.z) < max )
    {
        geometry.vertices.push(pointA);
        geometry.vertices.push(pointB);
        var line = new THREE.Line(geometry, material);
        scene.add(line);
    }
    else
    {
        console.debug(pointA.x.toString() + ':' + pointA.y.toString() + ':' + pointA.z.toString() + ':' +
        pointB.x.toString() + ':' + pointB.y.toString() + ':' + pointB.z.toString());
    }
}
function getFactorPos( val, factor, step )
{
    return step / factor * val;
}
function drawParticleLine(pointA,pointB)
{
    var factor = 50;
    for( var i = 0; i < factor; i++ )
    {
        var x = getFactorPos( pointB.x - pointA.x, factor, i );
        var y = getFactorPos( pointB.y - pointA.y, factor, i );
        var z = getFactorPos( pointB.z - pointA.z, factor, i );
        addNewParticle( new THREE.Vector3( pointA.x+x,pointA.y+y,pointA.z+z ), Math.max(1, window.innerWidth / 500) );
    }
}
function onDocumentMouseDown( event ) {
    var mouse3D = new THREE.Vector3( ( event.clientX / window.innerWidth ) * 2 - 1, //x
        -( event.clientY / window.innerHeight ) * 2 + 1, //y
        0.5 ); //z
    projector.unprojectVector( mouse3D, camera );
    mouse3D.sub( camera.position );
    mouse3D.normalize();
    var raycaster = new THREE.Raycaster( camera.position, mouse3D );
    var intersects = raycaster.intersectObjects( objects );
// Change color if hit block
    if ( intersects.length > 0 ) {
        intersects[ 0 ].object.material.color.setHex( Math.random() * 0xffffff );
    }
    render();
}
var radius = 600;
var theta = 0;
function render() {
    renderer.render( scene, camera );
}
</script>
<div>
</body>
</html>

    */