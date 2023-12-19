<?php include "../includes/header.php"; ?>

<!-- Asegúrate de que tu navbar esté incluido dentro del header o inclúyelo aquí -->

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="responsive-iframe-container">
                <iframe src="https://calendar.google.com/calendar/embed?src=c_a9f8fdfe8485d50e4f18171d291c192cf5b660617611be05228b2be8aa7951a2%40group.calendar.google.com&ctz=America%2FLima" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>

<style>
.responsive-iframe-container {
    position: relative;
    overflow: hidden;
    padding-top: 56.25%; /* 16:9 Aspect Ratio */
}

.responsive-iframe-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
</style>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



<?php include "../includes/footer.php"; ?>
