<?php
$active = 1;
require ("head.php");
mustBeConnected();
mustBeAdmin();
$pdo = connectDB();
?>


<div class="container-lg m-5">
    <div class="row">
        <div class="col">
            <?php
            $query = $pdo->query('SELECT COUNT(*) AS nb FROM tickets WHERE state = 0');
            $nbnodo = $query->fetch();
            ?>
            <h6 class="display-6 text-danger">Tickets non-résolus <span class="badge badge-secondary"><?php echo $nbnodo["nb"]; ?></span></h2>
        </div>
        <div class="col">
            <?php
            $query = $pdo->query('SELECT COUNT(*) AS nb FROM tickets WHERE state = 1');
            $nbdo = $query->fetch();
            ?>
            <h6 class="display-6 text-success">Tickets résolus <span class="badge badge-secondary"><?php echo $nbdo["nb"]; ?></span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col overflow-auto" style="height: 80vh;">

            <?php
            $query = $pdo->query("SELECT * FROM tickets WHERE state=0 ORDER BY sending_date ASC");
            $result = $query->fetchAll();
            foreach($result as $ticket){
                ?>
                <?php
                $query = $pdo->query('SELECT * FROM users WHERE id='.$ticket["user"]);
                $result = $query->fetchAll();
                foreach($result as $user){
                    ?>

                    <div class="card">
                        <h5 class="card-header">
                            <span class="badge badge-debian"><?php echo $ticket["id"] ?></span>
                            <?php echo $user["lastname"];?> <?php echo $user["firstname"];?> | <?php echo $ticket["sending_date"];?>
                        </h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title"><?php echo $ticket["title"];?></h5>
                                    <p class="card-text"><?php echo $ticket["content"];?></p>
                                </div>
                                <div class="col-auto">
                                    <a href="../<?php echo $ticket["image"];?>"><img src="../<?php echo $ticket["image"];?>" class="tiny-avatar img-fluid" alt=""></a>
                                </div>
                            </div>
                            <a href="mailto:<?php echo $user["email"]; ?>" class="btn btn-info">Répondre par mail</a>
                            <a href="admFunctions/delTicket.php?id=<?php echo $ticket["id"]; ?>" class="btn btn-danger">Supprimer le ticket</a>
                        </div>
                    </div>
                    <hr>
                    <?php ;}} ?>
        </div>

        <div class="col overflow-auto" style="height: 80vh;">

            <?php
            $query = $pdo->query("SELECT * FROM tickets WHERE state=1 ORDER BY sending_date DESC");
            $result = $query->fetchAll();
            foreach($result as $ticket){
                ?>
                <?php
                $query = $pdo->query('SELECT * FROM users WHERE id='.$ticket["user"]);
                $result = $query->fetchAll();
                foreach($result as $user){
                    ?>

                    <div class="card">
                        <h5 class="card-header">
                            <span class="badge badge-debian"><?php echo $ticket["id"] ?></span>
                            <?php echo $user["lastname"];?> <?php echo $user["firstname"];?> | <?php echo $ticket["sending_date"];?>
                        </h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title"><?php echo $ticket["title"];?></h5>
                                    <p class="card-text"><?php echo $ticket["content"];?></p>
                                </div>
                                <div class="col-auto">
                                    <a href="../<?php echo $ticket["image"];?>"><img src="../<?php echo $ticket["image"] ?>" class="tiny-avatar img-fluid" alt=""></a>
                                </div>
                            </div>
                            <a href="mailto:<?php echo $user["email"]; ?>" class="btn btn-info">Répondre par mail</a>
                            <a href="admFunctions/reTicket.php?id=<?php echo $ticket["id"]; ?>" class="btn btn-warning">Réouvrir le ticket</a>
                        </div>
                    </div>
                    <hr>
                <?php }} ?>
        </div>
    </div>


</div>

<script>
    function getTime () {
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();
        hours = ((hours < 10) ? " 0" : " ") + hours;
        minutes = ((minutes < 10) ? ":0" : ":") + minutes;
        seconds = ((seconds < 10) ? ":0" : ":") + seconds;
        var myHour = document.getElementById("heure");
        myHour.textContent = hours + minutes + seconds;
        setTimeout("getTime()",1000);
    }
    getTime();
</script>
</body>

</html>
