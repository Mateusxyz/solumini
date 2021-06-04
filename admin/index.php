<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Home CSS -->
    <link href="../styles/home.css" rel="stylesheet">
    <title>Solumini</title>
  </head>
  <body>
    <!--<meta http-equiv="refresh" content="2">-->
    <!-- Bootstrap Bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <?php include "../components/header.html" ?>
        <!-- Actual Content -->
        <div class="container-fluid table-responsive">
            <h2 class="d-flex justify-content-start align-items-center m-2">Empresas:<hr class="container-fluid ms-2"></h2>
            <form  class="d-flex container-fluid p-4 flex-row " action="#" onsubmit="insertCompany()">
                    <input class="form-control m-1" placeholder="Nome" id="name" type="text" required>    
                    <input class="form-control m-1" placeholder="Categoria" id="category_id" type="text" required>
                    <input class="form-control m-1" placeholder="Cidade" id="city" type="text" required>
                    <input class="form-control m-1" placeholder="Estado" id="state" type="text" required>    
                    <input class="form-control m-1" placeholder="Descrição" id="description" type="text" required>
                    <input class="form-control m-1" placeholder="Endereço" id="address" type="text" required>
                    <button class="form-control m-1 btn btn-primary" id="name" type="submit">Adicionar</button>
            </form>
            <div class="row p-sm-4">
                <form action="#" onsubmit="saveUpdate()">
                    <table class="table fs-sm-4 table-striped table-sm" id="cont">
                        
                        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
                        <script>
                            let table=[];
                            let base_data=[]
                            loadTable()
                            //faz a requisição de select e gera a tabela
                            function loadTable() {
                                document.getElementById('cont').innerHTML=(`
                                <tr scope="row" class="text-center">
                                    <th scope="col">id</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Cidade</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Endereço</th>
                                    <th scope="col" >Apagar</th>
                                </tr>`)
                                
                                axios.get(`/api/functions/readCompanies.php/`)
                                .then(({data})=>{
                                base_data=data
                                data.forEach(element => {
                                    document.getElementById('cont').innerHTML+=(
                                        `<tr scope="row" class="text-center" id="${element.id}"\)>
                                            <td scope="col">${element.id}</td>
                                            <td scope="col"><input class="form-control" type="text" value="${element.name}" oninput="inputChange(${element.id},'name',0)" required></td>
                                            <td scope="col"><input class="col-2 form-control" type="text" value="${element.category_id}" oninput="inputChange(${element.id},'category_id',1)" required></td>
                                            <td scope="col"><input class="form-control" type="text" value="${element.city}" oninput="inputChange(${element.id},'city',2)" required></td>
                                            <td scope="col"><input class="form-control" type="text" value="${element.state}" oninput="inputChange(${element.id},'state',3)" required></td>
                                            <td scope="col"><input class="form-control" type="text" value="${element.description}" oninput="inputChange(${element.id},'description',4)" required></td>
                                            <td scope="col"><input class="form-control" type="text" value="${element.address}" oninput="inputChange(${element.id},'address',5)" required></td>
                                            <td scope="col"><button type="button" class="btn close" onclick="elementDelete(${element.id})">  <span aria-hidden="true">&times;</span></button></td>
                                        </tr>`
                                    )
                                });
                                document.getElementById('cont').innerHTML+=`<button type="submit" class="btn btn-primary m-2">Salvar</button> <a href="/admin/contracts" class="btn btn-primary m-2">Contratos ></a>`
                                })
                            }
                            //ouve mudanças nos inputs da tabela e carrega eles na var table
                            function inputChange(row,field,id) {
                                let found=table.findIndex(el=>el.id==row)
                                if(found>=0){
                                    table[found][field]=document.getElementById(row).querySelectorAll('input')[id].value
                                }else{
                                   found=base_data.find(el=>el.id==row)
                                   if(found){
                                    table.push(found)
                                    inputChange(row,field,id)
                                   }
                                }
                                
                            }
                            //faz a requisição para o update do back
                            function saveUpdate() {
                                axios.post(`/api/functions/updateCompanies.php/`,{table})
                                .then((data)=>{
                                    if(data.data=="OK"){
                                        loadTable()
                                        toast(true)
                                        
                                    }else{
                                        toast(false)
                                    }
                                    
                                })
                            }
                            //pega os campos do form faz a requisição para o insert do back
                            function insertCompany(params) {

                                
                                var info={
                                    name:document.getElementById("name").value,
                                    category_id:document.getElementById("category_id").value,
                                    city:document.getElementById("city").value,
                                    state:document.getElementById("state").value,
                                    description:document.getElementById("description").value,
                                    address:document.getElementById("address").value
                                }
                                
                                axios.post(`/api/functions/insertCompany.php/`,{info})
                                .then((data)=>{
                                    if(data.data=="OK"){
                                        loadTable()
                                        toast(true)
                                        
                                    }else{
                                        toast(false)
                                    }
                                    
                                })
                                //reset dos campos
                                document.getElementById("name").value="";
                                    document.getElementById("category_id").value="";
                                    document.getElementById("city").value="";
                                    document.getElementById("state").value="";
                                    document.getElementById("description").value="";
                                    document.getElementById("address").value="";
                            }
                            //faz a requisição de delete para o back e recarrega a tabela
                            function elementDelete(row){
                                axios.post(`/api/functions/deleteCompany.php/`,{id:row})
                                .then((data)=>{
                                    if(data.data=="OK"){
                                        
                                        loadTable()
                                        toast(true)

                                    }else{
                                        toast(false)
                                    }
                                    
                                })
                                
                            }
                            //feedback visual do request
                            function toast(toast_result) {
                                var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                                var toastList = toastElList.map(function (toastEl) {
                                return new bootstrap.Toast(toastEl, {autohide:true,delay:2000})
                                })
                                if(toast_result){
                                    toastList[0].show()
                                }else{
                                    toastList[1].show()
                                }
                                
                            }
                            
                        </script>
                        
                    </table>
                    </form>    
                    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false">
                        <div class="toast-body">
                            Salvo com Sucesso
                        </div>
                    </div>
                    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false">
                        <div class="toast-body">
                            Não Salvo
                        </div>
                    </div>
            </div>
        </div>
    
    
    </body>
</html>