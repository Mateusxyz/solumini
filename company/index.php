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
        <div class="container-fluid" id="cont">
            
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script>
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const id = urlParams.get('id')
                axios.get(`../api/functions/readCompany.php?id=${id}`)
                        .then(({data})=>{
                            console.log(data)
                                document.getElementById('cont').innerHTML+=(
                                    `<h2 class="d-flex justify-content-start align-items-center m-2 text-nowrap">${data[0].name}<hr class="container-fluid ms-2"></h2>
                                    <div class="m-2 row">
                                          <h3 class="d-flex justify-content-start align-items-center m-2 text-nowrap">Categoria:</h3>
                                          <h5 class="m-3 mt-1 mb-1">${data[0].cat_name}</h5>
                                          <h3 class="d-flex justify-content-start align-items-center m-2 text-nowrap" id="tel_title">Telefone(s):</h3>
                                          <span id="tel"></span>
                                          <h3 class="d-flex justify-content-start align-items-center m-2 text-nowrap">Endereço:</h3>
                                          <h5 class="m-3 mt-1 mb-1">${data[0].address}, ${data[0].city}-${data[0].state}</h5>
                                    </div>
                                    <div class="m-2 row">
                                          <h3 class="d-flex justify-content-start align-items-center m-2 text-nowrap">Descrição:</h3>
                                          <h5 class="m-3 mt-1 mb-1">
                                                      
                                                ${data[0].description}
                                            </h5>
                                    </div>`
                                )
                                if (data[0].number) {
                                    data.sort((a,b)=>a.is_main?-1:0)
                                    let number=data.map((el,n)=>`<h5 class="m-3 mt-1 mb-1">${el.is_main.toLowerCase()=='1'?"Principal: ":"Telefone: "+(n+1)} (${el.number.slice(0,2)})${el.number.slice(2)}</h5>`)
                                    number.forEach(element => {
                                        document.getElementById("tel").innerHTML+=element
                                    });
                                } else {
                                    document.getElementById("tel_title").innerHTML=""
                                }
                                
                })
            </script>  
        </div>
    
    
    </body>
</html>