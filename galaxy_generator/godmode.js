/*
	star[]
		starTyp
		pos[x,y,z]
		dia
		star !!!!
		planets[]
			pClass
			athmo {}
				O: 2000000000,
				C: 999999999999,
				H: 60000000000
			litho {}
				Fe: 100000000,
				Si: 100000000,
				S: 1000000
			livable
			radius
			grav
			dia
*/

starTypes = []
starChance = []
planTypes = []
planChance = []
systems = []

starTypes[0] = {
	name: 'Double Star',
	chance: 5,
	planets: 0,
	gravZone: 25,
	goldZone: 0,
	hotZone:0,
	suckZone: 3,
	diam: 1
}
starTypes[1] = {
	name: 'Black Hole',
	chance: 1,
	planets: 2,
	gravZone: 30,
	goldZone: 0,
	hotZone:0,
	suckZone: 29,
	diam: 0,
	planRule: 0
}
starTypes[2] = {
	name: 'White Dwarf',
	chance: 3,
	planets: 20,
	gravZone: 15,
	goldZone: 10,
	hotZone:7,
	suckZone: 3,
	diam: 2
}
starTypes[3] = {
	name: 'Blue Giant',
	chance: 3,
	planets: 5,
	gravZone: 20,
	goldZone: 17,
	hotZone: 10,
	suckZone: 5,
	diam: 3
}
starTypes[4] = {
	name: 'Red Giant',
	chance: 3,
	planets: 5,
	gravZone: 20,
	goldZone: 10,
	hotZone: 5,
	suckZone: 5,
	diam: 3
}
starTypes[5] = {
	name: 'Newtron Star',
	chance: 1,
	planets: 1,
	gravZone: 20,
	goldZone: 0,
	hotZone: 0,
	suckZone: 15,
	diam: 1,
	planRule: 0
}

/*
blauer zwerg O5	klein heiße
gelber zwerg G2 klein mittelheiß
roter zwerg M klein kalt
brauner zwerg L klein eigentlich gasriese
roter Riese K0 grob kalt, keine nahen planeten wegen umwandlung aus zwerg
blaue Riesen B groß heiß
rote überriesen M entstehen wie rote risen nur aus blauen riesen keine heiß groß, keine nahen planeten
weißer zwerg A erdgroß kalt hell, keine nahen planeten hohe grav
schwarzer zwerg - erdgroße kohlenstoff oder eisenkugel wie weißer zwerg hohe grav
neutronenstern - nur trümmer strake gravitation viele ress unbewohnbar
schwarzes loch - kein entkommen, nicht scannbar keine bewohnbaren planeten keine nahen planeten ehr trümmer
*/

planTypes[0] = {
	clHot: 'M',
	clGold: '',
	clcold: '',
	name: '',
	chance: 1,
	athmo: {O:100000,N:1000,C:100000},
	bewohnbar: 2,
	gravity: 1,
	bodensch: {Fe:1000000,Au:1000,Si:100000,S:10000},
	minDia: 1,
	maxDia: 4
}
planTypes[1] = {
	clHot: 'O',
	clGold: ,
	clcold: '',
	name: '',
	chance: 1,
	athmo: {O:100000,N:1000,H:100000},
	bewohnbar: 2,
	gravity: 1.2,
	bodensch: {O:100000,H:100000},
	minDia: 1,
	maxDia: 4
}

/*Klasse	Bezeichnung	Bemerkung	Oberfläche	Atmosphäre	Lage im Planetensystem	Beispiele
A	Geothermal	Besiedlung ohne technische Unterstützung nicht möglich	geologisch aktiv, teilweise geschmolzen	giftige Gase	Ökosphäre oder kalte Zone	Gothos
B	Geomorteus	Besiedlung ohne technische Unterstützung nicht möglich	hohe Strahlung und Temperatur, teilweise geschmolzen	dünne Atmosphäre, giftige Gase	heiße Zone	Merkur
C	Geoinaktiv	Besiedlung ohne technische Unterstützung nicht möglich	sehr niedrige Temperaturen, feste, felsige und gefrorene Oberfläche	dünne Atmosphäre, giftige Gase	Ökosphäre oder kalte Zone	Pluto, Titan
D	Planetoid/Zwergplanet/Mond	Besiedlung ohne technische Unterstützung nicht möglich	sehr starke Temperaturschwankungen, feste, felsige Oberfläche voller Krater	Atmosphäre nur in Spuren vorhanden	variabel	Erdmond, Ganymed, Ceres
E	Geoplastisch	Besiedlung ohne technische Unterstützung nicht möglich	geologisch sehr aktiv, vorwiegend geschmolzene Oberfläche	giftige Gase, Wasserdampf	Ökosphäre oder kalte Zone	Excalbia
F	Geometallisch	Besiedlung ohne technische Unterstützung nicht möglich	geologisch aktiv, vorwiegend feste Oberfläche, dünne Kruste	giftige Gase, Wasserdampf	Ökosphäre oder kalte Zone	Janus IV
G	Geokristallin	Besiedlung ohne technische Unterstützung nicht möglich	geologisch aktiv, vorwiegend feste Oberfläche, stabile Kruste	giftige Gase, Wasserdampf	Ökosphäre oder kalte Zone	Delta Vega
H	Wüstenplanet	Besiedlung ohne technische Unterstützung nicht möglich	geologisch inaktiv, feste Oberfläche, hohe Oberlächentemperaturen	trockene Atmosphäre, enthält Sauerstoff	Ökosphäre oder heiße Zone	Tau Cygna
K	bedingt bewohnbar	Besiedlung nach Terraforming möglich	geologisch kaum aktiv, feste Oberfläche, stabile Kruste	trockene Atmosphäre, viel CO2 vorhanden	Ökosphäre oder kalte Zone	Mars
L	Marginal	Besiedlung ist möglich	geologisch kaum aktiv, feste Oberfläche, stabile Kruste, flüssiges Wasser in geringen Mengen vorhanden	Sauerstoff, Stickstoff, Edelgase, viel Kohlendioxid, Wasserdampf	Ökosphäre oder kalte Zone	Indri VIII
M	Terrestrisch (bewohnbar)	optimale Bedingungen für humanoides Leben	geologisch kaum aktiv, feste Oberfläche, stabile Kruste, flüssiges Wasser in größeren Mengen vorhanden	Sauerstoff, Stickstoff, Edelgase, wenig CO2, Wasserdampf	Ökosphäre	Erde
N	Abnehmend	Besiedlung ist nach Terraforming möglich	geologisch kaum aktiv, feste Oberfläche, stabile Kruste, flüssiges Wasser in geringen Mengen vorhanden	starker Treibhauseffekt, viel Kohlendioxid, viel Wasserdampf	Ökosphäre oder heiße Zone	Venus
O	Ozanisch (bewohnbar)	Besiedlung ist möglich	Oberfläche zu mehr als 80% mit flüssigem Wasser bedeckt	Sauerstoff, Stickstoff, Edelgase, wenig CO2, viel Wasserdampf	Ökosphäre	Argo
P	Vereist	Besiedlung nach Terraforming möglich	geologisch kaum aktiv, feste vereiste Oberfläche, stabile Kruste, niedrige Temperaturen	trockene Atmosphäre, Sauerstoff vorhanden	Ökosphäre oder kalte Zone	Exo III
Gasplaneten
Klasse	Bezeichnung	Bemerkung	Oberfläche	Atmosphäre	Lage im Planetensystem	Beispiele
I	Superriese	Besiedlung nicht möglich	keine feste Oberfläche	ausgedehnte Atmosphäre, vorwiegend Wasserstoff und Helium	variabel	Q'tahL
J	Gasriese	Besiedlung nicht möglich	keine feste Oberfläche	ausgedehnte Atmosphäre, vorwiegend Wasserstoff und Helium	variabel	Jupiter, Saturn, Uranus und Neptun
S, T	Ultrariese / Brauner Zwerg	Besiedlung nicht möglich	keine feste Oberfläche, hohe Temperaturen, starke infrarote Strahlung	ausgedehnte Atmosphäre, vorwiegend Wasserstoff und Helium	variabel	Delta 10 (S), Optima Alpha 5 (T)
Exotische Planetenformen 
Klasse	Bezeichnung	Bemerkung	Oberfläche	Atmosphäre	Lage im Planetensystem	Beispiele
Q	Variabel	Besiedlung ohne technische Unterstützung nicht möglich	feste Oberfläche	meteorologisch sehr aktive Atmosphäre, Kohlendioxid, Stickstoff, Sulfide	stark exzentrische Bahn	-
R	interstellarer Wanderer	Besiedlung ohne technische Unterstützung nicht möglich	gefrorene vereiste Oberfläche, sehr niedrige Temperaturen	variable Atmosphäre, zumeist aber gefroren und dünn	interstellar	-
X, Y, Z	"Dämon-Klasse"	Besiedlung nicht möglich	erweichte und teilweise geschmolzene Oberfläche, hohe Temperaturen, starke Strahlung	meteorologisch sehr aktive Atmosphäre, korrosive Substanzen	variabel	-

asteroiden gürtel unbewohnbar, aber gute bodenschätze
*/

function getStarChance() {
	if(starChance.length > 0) {
		return starChance;
	}
	alen = starTypes.length;
	chances = [];
	for(var i = 0;i<alen;i++) {
		c = starTypes[i]['chance'];
		alert(c);
		for(var j=0;j<c;j++){
			chances.push(i);
		}
	}
	return chances;
}		

function getPlanChance() {
	if(planChance.length > 0) {
		return planChance;
	}
	alen = planTypes.length;
	chances = [];
	for(var i = 0;i<alen;i++) {
		c = planTypes[i]['chance'];
		alert(c);
		for(var j=0;j<c;j++){
			chances.push(i);
		}
	}
	return chances;
}

function randPos(existObjNum) {
	var preset = 500;
	var multip = 10;
	var xu 	   = 100;
	var yu     = 100;
	var zu     = 500;
	
	winkel = Math.random() *2*Math.PI;
	entfern = (Math.random() * multip * existObjNum)+preset;
	xr = (Math.random()*2*xu)-xu;
	yr = (Math.random()*2*yu)-yu;
	zr = Math.floor(((Math.random()*2*zu)-zu)*((existObjNum % 5)+1) );
	
	var pos = [0,0,zr,Math.floor(entfern)];
	pos[0] = Math.floor(Math.cos(winkel)*entfern);
	pos[1] = Math.floor(Math.sin(winkel)*entfern);
	return pos;
}

function makePlanets(starID) {
	
	planets = []
	for(i=0;i<starTypes[starID].planets;i++) {
		//radius festlegen
		r = Math.floor(Math.random()*starTypes[starID].gravZone);
		//typ festlegen
		typ = getPlanChance()[Math.floor(Math.random() * getPlanChance().length)];
		//zone festlegen und evtl verwerfen
		if(radius > starTypes[starID].goldZone) {
			temp = '-215 - -150';
			live = -1;
			pClass = starTypes[starID].clHot;
		}else if(radius > starTypes[starID].hotZone) {
			temp = '-50 - +45';
			live = 1;
			pClass = starTypes[starID].clGold;
		}else if(radius > starTypes[starID].suckZone) {
			temp = '+220 - +400';
			live = -2;
			pClass = starTypes[starID].clCold;
		}else{
			continue;
		}
		//lebenumgebung berechnen
		live = live + planTypes[typ].bewohnbar;
		
		// planeten restriktion anwenden
		if (typeof starTypes[starID].planRule !== 'undefined') {
			pClass = starTypes[starID].planRule;
		}
		
		//durchmesser
		d=planTypes[typ].maxDia - planTypes[typ].minDia;
		diameter = Math.floor(Math.random*d)+planTypes[typ].minDia;
		//gravitation
		g = dia*planTypes[typ].gravity
		//planet obj erzeugen
		planet = {
			pClass: pCLass,
			livable: live,
			radius: r,
			grav: g,
			dia: diameter,
			athmo: {},
			litho: {}
		}
		
		/*TODO
		athmo: {}
			O: 2000000000,
			C: 999999999999,
			H: 60000000000
		litho {}
			Fe: 100000000,
			Si: 100000000,
			S: 1000000
		*/
		
		planets.push(planet);
	}
	return planets;
}

function makeStars() {
	var num = 100; //mehr
	var zoom = 0.005; // weg
	var centerX = 500;
	var centerY = 500;
	var centerZ = 1500;
	
	var stern = {};

	for(var i = 0;i<num;i++){
		//position ermitteln
		pos = randPos(i);
		//typ ermitteln
		typ = getStarChance()[Math.floor(Math.random() * getStarChance().length)];
		
		//stern zusammenbauen
		stern = {
			typID: typ,
			position: pos,
			planets: [],	
			//TODO
		}
	}
}