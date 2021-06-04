<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Index CSS -->
    <link href="./styles/index.css" rel="stylesheet">
    <title>Solumini</title>
  </head>
  <body>
    <!--<meta http-equiv="refresh" content="2">-->
    <!-- Bootstrap Bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <?php include "./components/header.html" ?>
        <!-- Actual Content -->
        <div class="container-fluid">
            <h2 class="d-flex justify-content-start align-items-center m-2">Categorias<hr class="container-fluid ms-2"></h2>
            <div class="row" id="cont">
                    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                    <script>
                        axios.get('api/functions/countCategory.php')
                        .then(({data})=>{
                            console.log(data)
                            data.forEach(element => {
                                document.getElementById('cont').innerHTML+=(
                                    `<a href="./category?id=${element.id}" class="p-3 pb-1 col-12 col-sm-4 text-reset text-decoration-none">
                                        <div class="d-flex align-items-center card col-12 ">
                                            <div class="card-body">${element.name} ${element['COUNT(category_id)']}</div>
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