<?php if(!isset($_SESSION['pos'])||!isset($_SESSION['user'])):?>
<div class="row">

        <div class="col s6">
            <a href="./user/create">
            <div class="btn signbtn">
            <p>Sign Up</p>
            </div>
            </a>
        </div>


        <div class="col s6">
            <a href="./user/login">
            <div class="btn signbtn">
                <p>Log In</p>
            </div>
            </a>
        </div>


</div>
<?php endif;?>
<?php if(isset($_SESSION['pos'])&&isset($_SESSION['user'])) {

        switch ($_SESSION['pos']) {
            case "pr":
                header('Location: /overview/principal');
                break;
            case "se":
                header('Location: /overview/secretary');
                break;
            case "st":
                header('Location: /overview/student');
                break;
            case "te":
                header('Location: /overview/teacher');
                break;
        }
    }

?>

