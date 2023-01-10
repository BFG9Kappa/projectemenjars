<html>
    <head>
        <script>
            //console.log('hola');

            const url = 'http://127.0.0.1:8000/api/comandas/';

            async function loadIntoTable(url){
                const response = await fetch(url);
                const json = await response.json();

                const rows = json.data;

                const table = document.getElementById('taula');
                for (const row of rows){
                    //console.log(row)
                    const rowElement = document.createElement("tr");
                    const idCell = document.createElement("td");
                    idCell.textContent = row.id;
                    const nomCell = document.createElement("td");
                    nomCell.textContent = row.nom;
                    rowElement.appendChild(idCell);
                    rowElement.appendChild(nomCell);

                    taula.appendChild(rowElement);
                }
            }

            loadIntoTable(url);


        </script>
    </head>
    <body>
        CRUD COMANDAS    
        <table>
            <thead>
               <tr>
                <th>id</th>
                <th>Name</th>
               </tr>
            </thead>
            <tbody id="taula">
          

            </tbody>
        </table>
    </body>
</html>
