//var time = 3000;
var numofitemsCore = 10;
var numofitemsGenl = 9;

//menu constructor
function menu(allitems,thisitem,startstate){ 
  callname= "gl"+thisitem;
  divname="fig"+thisitem;  
  this.numberofmenuitems = allitems;
  this.caller = document.getElementById(callname);
  this.thediv = document.getElementById(divname);
  this.thediv.style.visibility = startstate;
}

//menu methods
function ehandler(event,theobj,egsign){
  for (var i=1; i<= theobj.numberofmenuitems; i++){
    var shutdiv =eval( "figitem"+egsign+i+".thediv");
    shutdiv.style.visibility="hidden";
  }
  theobj.thediv.style.visibility="visible";
}
				
function closesubnav(event){
  if ((event.clientY <48)||(event.clientY > 107)){
    for (var i=1; i<= numofitemsCore; i++){
      var shutdiv =eval('figitemCore'+i+'.thediv');
      shutdiv.style.visibility='hidden';
    }
	for (var i=1; i<= numofitemsGenl; i++){
      var shutdiv =eval('figitemGenl'+i+'.thediv');
      shutdiv.style.visibility='hidden';
    }
  }
}
