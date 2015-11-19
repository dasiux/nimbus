(function(window){
    var nbsMap=function(uni){
        this.uni=uni;
    };

    window['nimbus']=new (function(){
        this.init=function(what,data){
            console.log(what);
            console.log(data);
            switch(what){
                case 'map':
                    console.log('map:init');
                    this.map=new nbsMap(data.uni);
                case 'game':
                default:
                    throw 'nimbus.init(['+what+']invalid);';
            }
        };
    });
})(window);