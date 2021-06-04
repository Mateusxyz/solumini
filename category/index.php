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
        <div class="container-fluid">
            <h2 class="d-flex justify-content-start align-items-center m-2 text-nowrap"><span id="h2Category">Farmacias</span><hr class="container-fluid ms-2"></h2>
            <div class="row" id="cont">
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script>
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const id = urlParams.get('id')
                axios.get(`../api/functions/readCategory.php?id=${id}`)
                        .then(({data})=>{
                            
                            document.getElementById('h2Category').innerHTML=`${data[0].cat_name}`
                            
                            data.forEach(element => {
                                document.getElementById('cont').innerHTML+=(
                                    `<a href="../company?id=${element.id}" class="p-3 pb-1 col-12 col-sm-6 col-md-4 text-reset text-decoration-none">
                                        <div class="d-flex align-items-start card col-12 p-3" style="min-height:230px; max-height:230px;">
                                            <h5 class="card-title">${element.name}</h5>
                                            ${new Date(element.contract_expire_date+"T00:00:00").getTime()>new Date().getTime()?'<span class="badge rounded-pill bg-primary">Recomendado</span>':''}
                                            <div class="card-body">
                                                <p>Cidade: ${element.city}-${element.state}</p>
                                                <p>End: ${element.address}</p>
                                            </div>
                                        </div> 
                                    </a>`
                                )
                            });
                })
            </script>  
            </div>
        </div>
    
    
    </body>
</html>