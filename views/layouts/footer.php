<div class="content"></div>
<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">LuxLife@</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->
<!--slider-->
<script src="/online_shop/template/js/jquery.js"></script>
<script src="/online_shop/template/js/jquery.cycle2.min.js"></script>
<script src="/online_shop/template/js/jquery.cycle2.carousel.min.js"></script>
<!--slider-->
<script src="/online_shop/template/js/bootstrap.min.js"></script>
<script src="/online_shop/template/js/jquery.scrollUp.min.js"></script>
<script src="/online_shop/template/js/price-range.js"></script>
<script src="/online_shop/template/js/jquery.prettyPhoto.js"></script>
<script src="/online_shop/template/js/main.js"></script>
<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/online_shop/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>
</body>
</html>