class VueModifierAgenda{
    constructor(){
        this.html = document.getElementById("html-vue-modifier-agenda").innerHTML;
        this.modifierAgenda = null;
        this.agendaModif = null;
    }

    initialiserModifierAgenda(modifierAgenda){
        this.modifierAgenda = modifierAgenda;
    }

    setAgendaModif(agendaModif){
        this.agendaModif = agendaModif;
    }

    afficher(){

        document.getElementsByTagName("body")[0].innerHTML = this.html;
        document.getElementById("agenda-matiere").value = this.agendaModif.matiere;
        document.getElementById("agenda-type").value = this.agendaModif.type;
        document.getElementById("agenda-date").value = this.agendaModif.date;
        document.getElementById("agenda-description").value = this.agendaModif.description;
        document.getElementById("agenda-duree").value = this.agendaModif.duree;

        document.getElementById("formulaire-modifier").addEventListener("submit",evenement =>this.enregistrer(evenement));

    }

    enregistrer(evenement){
        evenement.preventDefault();

        let hash = window.location.hash;
        let navigation =  hash.match(/^#modifier-agenda\/([0-9]+)/);
        let id = navigation[1];

        let matiere = document.getElementById("agenda-matiere").value;
        let type = document.getElementById("agenda-type").value;
        let date = document.getElementById("agenda-date").value;
        let description = document.getElementById("agenda-description").value;
        let duree = document.getElementById("agenda-duree").value;

        this.modifierAgenda(new Agenda(matiere, type, date, description, duree, id));

    }
}