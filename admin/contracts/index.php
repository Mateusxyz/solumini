<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Home CSS -->
    <link href="../../styles/home.css" rel="stylesheet">
    <title>Solumini</title>
  </head>
  <body>
    <!--<meta http-equiv="refresh" content="2">-->
    <!-- Bootstrap Bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <?php include "../../components/header.html" ?>
        <!-- Actual Content -->
        <div class="container-fluid table-responsive">
            <h2 class="d-flex justify-content-start align-items-center m-2">Contratos:<hr class="container-fluid ms-2"></h2>
            <form  class="d-flex container-fluid p-4 flex-row " action="#" onsubmit="insertContract()">
                    <input class="form-control m-1" placeholder="Dono da Empresa" id="company_owner" type="text" required>    
                    <input class="form-control m-1" placeholder="ID da Empresa" id="company_id" type="text" required>
                    <input class="form-control m-1" placeholder="Vendedor" id="seller_name" type="text" required>
                    <input class="form-control m-1" placeholder="Vencimento ex: 2020-12-31" id="expire_date" type="text" required>
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
                                    <th scope="col">Dono da Empresa</th>
                                    <th scope="col">ID da Empresa</th>
                                    <th scope="col">Vendedor</th>
                                    <th scope="col">Data de Vencimento</th>
                                    <th scope="col">Apagar</th>
                                </tr>`)
                                
                                axios.get(`/api/functions/readContracts.php/`)
                                .then(({data})=>{
                                base_data=data
                                data.forEach(element => {
                                    document.getElementById('cont').innerHTML+=(
                                        `<tr scope="row" class="text-center" id="${element.id}"\)>
                                            <td scope="col">${element.id}</td>
                                            <td scope="col"><input class="form-control" type="text" value="${element.company_owner}" oninput="inputChange(${element.id},'company_owner',0)" required></td>
                                            <td scope="col"><input class="col-2 form-control" type="text" value="${element.company_id}" oninput="inputChange(${element.id},'company_id',1)" required></td>
                                            <td scope="col"><input class="form-control" type="text" value="${element.seller_name}" oninput="inputChange(${element.id},'seller_name',2)" required></td>
                                            <td scope="col"><input class="form-control" type="text" value="${element.expire_date}" oninput="inputChange(${element.id},'expire_date',3)" required></td>
                                            <td scope="col"><button type="button" class="btn close" onclick="elementDelete(${element.id})">  <span aria-hidden="true">&times;</span></button></td>
                                        </tr>`
                                    )
                                });
                                document.getElementById('cont').innerHTML+=`<button type="submit" class="btn btn-primary m-2">Salvar</button> <a href="/admin" class="btn btn-primary m-2">< Empresas</a>`
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
                                axios.post(`/api/functions/updateContracts.php/`,{table})
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
                            function insertContract() {

                                
                                var info={
                                    company_owner:document.getElementById("company_owner").value,
                                    company_id:document.getElementById("company_id").value,
                                    seller_name:document.getElementById("seller_name").value,
                                    expire_date:document.getElementById("expire_date").value
                                }
                                
                                axios.post(`/api/functions/insertContract.php/`,{info})
                                .then((data)=>{
                                    if(data.data=="OK"){
                                        loadTable()
                                        toast(true)
                                        
                                    }else{
                                        toast(false)
                                    }
                                    
                                })
                                //reset dos campos
                                    document.getElementById("company_owner").value.value="";
                                    document.getElementById("company_id").value="";
                                    document.getElementById("seller_name").value="";
                            }
                            //faz a requisição de delete para o back e recarrega a tabela
                            function elementDelete(row){
                                axios.post(`/api/functions/deleteContract.php/`,{id:row})
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