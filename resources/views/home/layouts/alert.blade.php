

<div class="alert alert-{{$status}}" role="alert">
    <div style="text-align: center">
        <b><span>{{$slot}}</span></b>
    </div>
</div>
<div class="alert alert-success" role="alert" hidden>重置密码成功!</div>
<script type="application/javascript" src="AmImages/jquery-1.10.1.min.js"></script>
<script type="application/javascript" src="js/bootstrap.min.js"></script>
<link  href="css/bootstrap.min.css" rel="stylesheet">
<script type="application/javascript">
    $(function () {
        $(".alert").delay(3000).hide(0)
    })
</script>