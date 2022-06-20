<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sparks Bank</title>
    <style>
        body{
            background-color: aquamarine;
            font-family: sans-serif;
        }
        h1{
            text-align: left;
            color: rgb(126, 29, 222);
        }
        /* .nav{
            background-attachment: fixed;
            background-color: aqua;
            text-align: right;
            padding: 10px;
        } */

        


        .row{
    margin-top: 5%;
    display: flex;
    justify-content: space-between;
}
.course-col{
    flex-basis: 31%;
    background: #fcfcfc;
    border-radius: 10px;
    margin-bottom: 5%;
    padding: 20px 12px;
    box-sizing: border-box;
    transition: 0.5s;

}
h3 a {
    text-decoration: none;
    font-weight: 600;
}
h3{
    text-align: center;
    font-weight: 600;
    margin: 10px 0;
}
.course {
    text-align: center;
    margin: 200px;
    margin-top: 150px;
    margin-bottom: 0px;
}

.course-col:hover{
    box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.2);
}

.header {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;    
    border-bottom: 2px solid gray;
    font-size: 50px;
    background-color:#0FEC48 ;
}
    </style>
</head>

<body>
    
<section class="header">
<h1 style="color: white">Sparks Bank</h1>
</section>

    <section class="course">
        <h2>Faclities </h2>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim odit consequatur culpa!</p>
        <div class="row">
          <div class="course-col">
            <h3><a href="transfer.php"> Transfer Money</a></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam, dolores!</p>
          </div>
          <div class="course-col">
            <h3><a href="history.php"> Transfer History</a></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam, dolores!</p>
          </div>
        </div>
    </section>
    
</body>
</html>