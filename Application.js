class Application {
  constructor(window, vueListeAgenda, vueAgenda, vueAjouterAgenda, vueModifierAgenda, agendaDao){

    this.window = window;

    this.vueListeAgenda = vueListeAgenda;

    this.vueAgenda = vueAgenda;

    this.vueAjouterAgenda = vueAjouterAgenda;
    this.vueAjouterAgenda.initialiserAjouterAgenda(agenda =>this.ajouterAgenda(agenda));

    this.vueModifierAgenda = vueModifierAgenda;
    this.vueModifierAgenda.initialiserModifierAgenda(agenda =>this.modifierAgenda(agenda));

    this.agendaDao = agendaDao;

    // C'est l'équivalent de function(){this.naviguer()}
    this.window.addEventListener("hashchange", () =>this.naviguer());

    this.naviguer();
  }

  naviguer(){
    let hash = window.location.hash;

    if(!hash){

      this.agendaDao.lister((listeAgenda) => this.afficherNouvelleListeAgenda(listeAgenda));

    }else if(hash.match(/^#ajouter-agenda/)){

      this.vueAjouterAgenda.afficher();

    }else if(hash.match(/^#modifier-agenda\/([0-9]+)/)){

      let navigation =  hash.match(/^#modifier-agenda\/([0-9]+)/);
      let idAgenda = navigation[1];


      this.agendaDao.chercher(idAgenda, (agenda) => this.afficherModifierAgenda(agenda));
    }else{

      let navigation = hash.match(/^#agenda\/([0-9]+)/);
      let idAgenda = navigation[1];

      this.agendaDao.chercher(idAgenda, (agenda) => this.afficherNouveauAgenda(agenda));
    }
  }

  afficherNouvelleListeAgenda(listeAgenda){

    //console.log(listeAgenda);
    this.vueListeAgenda.initialiserListeAgenda(listeAgenda);
    this.vueListeAgenda.afficher();
  }

  afficherNouveauAgenda(agenda){
    //console.log(agenda);
    this.vueAgenda.initialiserAgenda(agenda);
    this.vueAgenda.afficher();
  }

  afficherModifierAgenda(agenda){
    //console.log(agenda);
    this.vueModifierAgenda.setAgendaModif(agenda);
    this.vueModifierAgenda.afficher();
  }

  ajouterAgenda(agenda){
    this.agendaDao.ajouter(agenda, () => this.afficherListeAgenda());
  }

  modifierAgenda(agenda){
    this.agendaDao.modifier(agenda, () => this.afficherListeAgenda());
  }

  afficherListeAgenda(){
    this.window.location.hash = "#";
  }
}

new Application(window, new VueListeAgenda(), new VueAgenda(), new VueAjouterAgenda(), new VueModifierAgenda(), new AgendaDao());