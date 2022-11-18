<?php include_once 'Views/templates/header.php'; ?>

<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="<?php echo $data['producto']['imagen'] ?>" alt="Card image cap" id="product-detail">
                </div>
                <div class="row">
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-dark fa fa-chevron-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </div>
                    <!--End Controls-->
                    <!--Start Carousel Wrapper-->
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                        <!--Start Slides-->
                        <div class="carousel-inner product-links-wap" role="listbox">

                            <!--First slide-->
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="https://definicion.de/wp-content/uploads/2013/07/productos-tecnologicos.jpg" alt="Product Image 1">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="https://definicion.de/wp-content/uploads/2013/07/productos-tecnologicos.jpg" alt="Product Image 2">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="https://definicion.de/wp-content/uploads/2013/07/productos-tecnologicos.jpg" alt="Product Image 3">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/.First slide-->

                            <!--Second slide-->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="https://definicion.de/wp-content/uploads/2013/07/productos-tecnologicos.jpg" alt="Product Image 4">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="https://definicion.de/wp-content/uploads/2013/07/productos-tecnologicos.jpg" alt="Product Image 5">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="https://definicion.de/wp-content/uploads/2013/07/productos-tecnologicos.jpg" alt="Product Image 6">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/.Second slide-->
                        </div>
                        <!--End Slides-->
                    </div>
                    <!--End Carousel Wrapper-->
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-dark fa fa-chevron-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?php echo $data['producto']['nombre'] ?></h1>
                        <p class="h3 py-2"><?php echo MONEDA . ' ' . $data['producto']['precio'] ?></p>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Categoria</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong><?php echo $data['producto']['categoria'] ?></strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p><?php echo $data['producto']['descripcion'] ?></p>

                        <form action="" method="GET">
                            <input type="hidden" id="idProducto" value="<?php echo $data['producto']['idproducto'] ?>">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Cantidad
                                            <input type="hidden" id="product-quanity" value="1">
                                        </li>
                                        <li class="list-inline-item"><span class="badge btn-util" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="badge btn-util" id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-util btn-lg" name="submit" value="buy">Comprar</button>
                                </div>
                                <div class="col d-grid">
                                    <button class="btn btn-util btn-lg" type="button" id="btnAddCart">Añadir al carrito</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="py-5">
    <div class="container">
        <div class="row text-left p-2 pb-3">
            <h4>Productos Relacionados</h4>
        </div>

        <!--Start Carousel Wrapper-->
        <div id="carousel-related-product">
            <?php foreach ($data['relacionados'] as $producto) { ?>

                <div class="p-2 pb-3">
                    <div class="product-wap card rounded-0">
                        <div class="card rounded-0">
                            <img class="card-img rounded-0 img-fluid" src="<?php echo $producto['imagen'] ?>">
                            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li><a class="btn btn-util text-white btnAddDeseo" href="#" prod="<?php echo $producto['idproducto'] ?>"><i class="fas fa-heart"></i></a></li>
                                    <li><a class="btn btn-util text-white mt-2" href="<?php echo BASE_URL . 'principal/detail/' . $producto['idproducto'] ?>"><i class="fas fa-eye"></i></a></li>
                                    <li><a class="btn btn-util text-white mt-2 btnAddCarrito" href="#" prod="<?php echo $producto['idproducto'] ?>"><i class="fas fa-cart-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['idproducto'] ?>" class="h3 logo text-decoration-none"><?php echo $producto['nombre'] ?></a>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">

                                <li class="pt-2">
                                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                </li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul>
                            <p class="text-center mb-0"><?php echo  MONEDA . ' ' . $producto['precio'] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>



<?php include_once 'Views/templates/footer.php'; ?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/detail.js'; ?>"></script>


<script src="<?php echo BASE_URL . 'assets/css/slick/slick.min.js'; ?>"></script>
<script>
    $('#carousel-related-product').slick({
        infinite: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 4,
        dots: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            }
        ]
    });
</script>


</body>

</html>