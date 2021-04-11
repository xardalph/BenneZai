function hideAllElementByClassNam(clName){ 
    var onglets = document.getElementsByClassName("onglet");
    //on masque tous les onglets
    for (var i = 0; i < onglets.length; i++) {
      onglets[i].style.display = 'none';
    }
  }
  
  function ShowElementById(idElm){
    document.getElementById(idElm).style.display = "inline-block";
  }
  
  function addClassActiveElm(idElm){
    var cl_btn_active = document.getElementsByClassName("active");
    //on retire la class Active de tous les onglets
    for (var i = 0; i < cl_btn_active.length; i++) {
      removeClass(cl_btn_active[i],"active") ;
    }  
    //on met la class active au bouton cliqué
    document.getElementById(idElm).className = "btnmateriel active";
    
  }
  
  function removeClass(e,c) {
    e.className = e.className.replace( new RegExp('(?:^|\\s)'+c+'(?!\\S)') ,'');
  }
  
  var DisplayHideOnglets = function() {
      //on masque tous les onglets
      hideAllElementByClassNam('onglet');
      
      //numero de l'onglet à afficher
     var NumOnglet = this.getAttribute("data-onglet");  
      
      //on affiche l'onglet
      if(typeof(NumOnglet) !="undefined" && NumOnglet!=null){
        ShowElementById("onglet_"+NumOnglet);
        addClassActiveElm("btn_"+NumOnglet);
      }
      
    
  };
  
  function initListener(){
    //on ajoute le listener
    var cl_btnmateriel = document.getElementsByClassName("btnmateriel");
    for (var i = 0; i < cl_btnmateriel.length; i++) {
      cl_btnmateriel[i].addEventListener('click', DisplayHideOnglets, false);
    }
  }
  
  //Initialisation
  initListener();
  
  //par défaut.. on affiche le premier onglet
  ShowElementById("onglet_1");