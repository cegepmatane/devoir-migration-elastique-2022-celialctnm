class AgendaDao{
    constructor(){
        this.URL = 'http://18.215.104.129/'
    }

    lister(action){
        fetch(this.URL + 'lister.php')
            .then(response => response.json())
            .then(data =>
            {
                let listeAgenda = [];
                for(let position in data){
                    let agenda = new Agenda(data[position].matiere,
                        data[position].type,
                        data[position].date,
                        data[position].description,
                        data[position].duree,
                        data[position].id);

                    //console.log(agenda);
                    listeAgenda.push(agenda);
                }
                action(listeAgenda);
            });
    }

    chercher(id, action){
        fetch(this.URL + 'chercher-par-id.php' + '?id=' + id)
            .then(response => response.json())
            .then(data =>
            {
                let agenda = new Agenda(data.matiere,
                    data.type,
                    data.date,
                    data.description,
                    data.duree,
                    data.id);
                action(agenda);
            });
    }

    ajouter(agenda, action){
        fetch(this.URL + 'ajouter.php',
            {
                method: 'POST',
                headers: {
                    'Content-Type':'application/x-www-form-urlencoded'
                },
                body: JSON.stringify(agenda),
            })
            .then(response => response.text())
            .then(data =>
            {
                console.log('Détail:', data);
                action();
            });
    }
}
