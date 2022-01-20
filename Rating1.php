<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../includes/database.php');
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rating</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Rating</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    </head>

    <body>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title">Rating</h5>
                            </center>
                            <p>Top 10 FYP II STUDENT LIST</p>

                            <!-- Table with stripped rows -->
                            <!-- <form acti"> -->

                            <table class="table">

                                <tbody>

                                    <?php
                                    //SQL query
                                    $strSQL = "SELECT * FROM rating WHERE UserID='2' ";


                                    //Execute the query (the recordset $rs contains the result)
                                    $rs = mysqli_query($link, $strSQL);

                                    //Loop the recordset $rs 
                                    //Each row will be made into an array ($row) using mysql_fetch_array 
                                    if ($rs->num_rows > 0) {
                                        $UserID = true;
                                    } else {
                                        $UserID = false;
                                    }
                                    ?>
                                    <?php
                                    if (!$UserID) {
                                    ?>

                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Student</th>
                                                <th scope="col">Project Details</th>
                                                <th scope="col">Rate</th>
                                            </tr>
                                        </thead>
                                        <?php


                                        $strSQL = "SELECT * FROM tabledisplay ";
                                        $i = 0;

                                        //Execute the query (the recordset $rs contains the result)
                                        $rs = $link->query($strSQL);

                                        //Loop the recordset $rs 
                                        //Each row will be made into an array ($row) using mysql_fetch_array 
                                        while ($row = mysqli_fetch_array($rs)) {
                                            $i++;

                                        ?>
                                            <form action="insertrating.php?id=<?php echo $row['FYPID']; ?>" method="post">
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td id="name">
                                                        <?php echo $row['Name']; ?>
                                                        <?php echo $row['MatricID']; ?>
                                                    </td>
                                                    <td><?php echo $row['ProjectName']; ?></td>
                                                    <td>
                                                        <div class="rateyo" id="rating" data-rateyo-rating="0" data-rateyo-num-stars="5" data-rateyo-score="3">
                                                        </div>
                                                        <span class='result'>0</span>
                                                        <input type="hidden" name="rating">

                                                        <div><input type="submit" name="submit" class="btn btn-primary"> </div>
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>
                                            </form>
                                    <?php }
                                    } //While loop
                                    ?>

                                </tbody>
                            </table>

                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>

            </div>
        </section>

</main><!-- End #main -->

<?php
include('../includes/footer.php');
include('../includes/scripts.php');
?>

<script>
    $(function() {
        $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :' + rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
</script>
</body>

</html>