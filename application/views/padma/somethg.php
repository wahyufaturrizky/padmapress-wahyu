
application/x-httpd-php page_article_list.php ( HTML document, ASCII text )
<section class="oth-articleNews ">

    <!-- Breadcrumbs -->

    <?php 

    if ( ! isset($_GET['page'])){

        $_GET['page'] = 1;

    }   

?>

        <style type="text/css">
            .owl-carousel .owl-item img {
                display: block;
                width: 100%;
                height: 349px;
                object-fit: cover;
            }
        </style>

        <div class="container-fluid container-custom-deep">

            <nav aria-label="breadcrumb " class="d-none d-sm-flex">

                <ol class="breadcrumb breadcrumb-transparent" style="padding-left: 0;">

                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>

                    <li class="breadcrumb-item active" aria-current="page">Orthodontic Article</li>

                </ol>

            </nav>

            <!-- End of Breadcrumbs -->

            <div class="row" style="display: <?= (count($article_headline) > 0) ? 'block': 'none' ; ?>">

                <div class="col-md-12">

                    <h1 class="oth-articleNews-heading  mt-30-resp d-none d-sm-flex">Headline News</h1>

                    <div class="owl-carousel owl-theme oth-article-featured">

                        <?php foreach ($article_headline as $z): ?>

                            <section class="oth-articleNews-featured">

                                <div class="row">

                                    <div class="col-sm-12 col-md-6">

                                        <div class="row mtb-15-resp d-md-block d-xl-none">

                                            <?php 

                                        $q = "select * from post_tag a inner join tag b on a.tag_id = b.tag_id where a.post_id = ".$z->post_id;

                                        $single_tag = $this->my_query->query($q);

                                        if ( $single_tag->num_rows() > 0) {

                                            foreach( $single_tag->result() as $tag ){

                                    ?>

                                                <label class="oth-sorting-cat" style="background-color: <?= $tag->tag_color; ?>;">
                                                    <?php echo $tag->tag_title  ?>
                                                </label>

                                                <?php 

                                        } }

                                    ?>

                                        </div>

                                        <h2 class="oth-articleNews-featuredTitle d-md-block d-xl-none"><?= $z->post_header ?></h2>

                                        <img src="<?= base_url() ?>assets/article/<?= $z->post_picture ?>" alt="" class="img-fluid oth-featuredImg">

                                    </div>

                                    <div class="col-sm-12 col-md-6">

                                        <div class="row d-none d-sm-flex" style="margin: 0 0 30px;">

                                            <?php 

                                        $q = "select * from post_tag a inner join tag b on a.tag_id = b.tag_id where a.post_id = ".$z->post_id;

                                        $single_tag = $this->my_query->query($q);

                                        if ( $single_tag->num_rows() > 0) {

                                            foreach( $single_tag->result() as $tag ){

                                    ?>

                                                <label class="oth-sorting-cat" style="background-color: <?= $tag->tag_color; ?>;">
                                                    <?php echo $tag->tag_title  ?>
                                                </label>

                                                <?php 

                                        } }

                                    ?>

                                        </div>

                                        <a href="<?= base_url() ?>Web/post?post_id=<?= $z->post_id ?>">

                                            <h2 class="oth-articleNews-featuredTitle d-none d-sm-flex"><?= $z->post_header ?></h2>

                                        </a>

                                        <h4 class="oth-articleNews-featuredDate"><?php echo set_date($z->post_date) ?></h4>

                                        <p class="oth-articleNews-featuredText">

                                        <?php 

                                        $string     =   $z->post_content;

                                        $string = strip_tags($string);

                                        if (strlen($string) > 290) {

                                            // truncate string

                                            $stringCut = substr($string, 0, 290);

                                            $endPoint = strrpos($stringCut, ' ');

                                            //if the string doesn't contain any space then it will cut without word basis.

                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);

                                            $string .= " ...";

                                        }

                                        echo $string;

                                    ?>

                                        </p>

                                        <a href="<?= base_url() ?>Web/post?post_id=<?= $z->post_id ?>" class="oth-articleNews-featuredMore">Read More</a>

                                    </div>

                                </div>

                            </section>

                            <?php endforeach ?>

                    </div>

                </div>

            </div>

        </div>

</section>

<section class="oth-searchTopic">

    <div class="container-fluid container-custom-deep">

        <div class="row">

            <div class="col-md-12">

                <div class="input-group">

                    <input class="form-control py-2 border-right-0 border" placeholder="Search Topics" id="example-search-input">

                    <a href="#"> <span class="input-group-append">

                        <div class="input-group-text bg-transparent search-custom"><i class="fa fa-search"></i></div>

                    </span></a>

                </div>

            </div>

        </div>

        <div class="row justify-content-center mt-15-resp oth-article-list" style="margin-top: 40px;">

            <div class="col-md-12">

                <div class="row">

                    <div class="col-md-3 oth-article-hidden">

                        <h4>Popular Search</h4>

                    </div>

                    <div class="col-12 col-md-8 oth-article-tag" style="padding-left:30px;">

                        <ul id="tags-list">

                            <?php 

                                $tagnumber = count($tags); 

                                if ($tagnumber >0) {

                                    $i  = 1;

                                    foreach ($tags as $result ) {

                                ?>

                                <a id="<?= $i ?>" href="<?= base_url() ?>Web/search?tag_id=<?= $result->tag_id ?>" class="oth-sorting-cat mytags" style="color:white;background-color:<?= $result->tag_color ?>; ">

                                    <?= $result->tag_title ?>

                                </a>

                                <?php $i++; ?>

                                    <?php

                                    }

                                }

                            ?>

                                        <?php if($tagnumber > 3){ ?>

                                            <a id="alltags" style="color:black;font-size: 12px !important" href="Javascript::void(0)" class="oth-sorting-cat"> Show All Tags

                             </a>

                                            <?php } ?>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<div class="container-fluid container-custom d-none d-sm-block" style="padding-top: 0; padding-bottom: 30px;">

    <hr class="oth-hr">

</div>

<!-- WEB ONLY -->

<section class="oth-popularArticle d-none d-sm-flex">

    <div class="container-fluid container-custom-deep">

        <div class="row">

            <div class="col-md-12">

                <div class="row">

                    <div class="col-md-12">

                        <div class="row" style="margin-bottom: 30px;">

                            <?php foreach ($article as $zxc){ ?>

                                <div class="col-md-6">

                                    <div class="oth-popularArticle-card">

                                        <div class="row no-gutters">

                                            <div class="col-sm-12 col-md-7" style="padding-right:15px;">

                                                <img style="height:201px;width:288px" src="<?= base_url() ?>assets/article/<?= $zxc->post_picture ?>" alt="" class="img-fluid">

                                            </div>

                                            <div class="col-sm-12 col-md-5" style="padding-top:15px;padding-right: 15px;">

                                                <h4 style="height:45px;">

                                            <a href="<?= base_url() ?>Web/post?post_id=<?= $zxc->post_id ?>" style="color:black">

                                                <?= $zxc->post_header ?>

                                            </a>

                                            </h4>

                                                <p class="popularArticle-card-date">
                                                    <?= set_date($zxc->post_date) ?>
                                                </p>

                                                <p class="popularArticle-card-text">

                                                    <?php 

                                                    $string     =   $zxc->post_content;

                                                    $string = strip_tags($string);

                                                    if (strlen($string) > 75) {

                                                        // truncate string

                                                        $stringCut = substr($string, 0, 75);

                                                        $endPoint = strrpos($stringCut, ' ');

                                                        //if the string doesn't contain any space then it will cut without word basis.

                                                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);

                                                        $string .= " ...";

                                                    }

                                                    echo $string;

                                                 ?>

                                                </p>

                                                <a href="<?= base_url() ?>Web/post?post_id=<?= $zxc->post_id ?>" class="popularArticle-card-more">Read More</a>

                                                <?php 

                                                $q = "select * from post_tag a inner join tag b on a.tag_id = b.tag_id where a.post_id = ".$zxc->post_id.' limit 1';

                                                $single_tag = $this->my_query->query($q);

                                                if ( $single_tag->num_rows() > 0) {

                                            ?>

                                                    <label class="float-right oth-sorting-cat " style="background-color: <?= $single_tag->row()->tag_color; ?>;">
                                                        <?php echo $single_tag->row()->tag_title  ?>
                                                    </label>

                                                    <?php 

                                                }

                                            ?>

                                            </div>

                                        </div>

                                    </div>

                                    &nbsp;

                                </div>

                                <?php } ?>

                        </div>

                        <div class="oth-pagination d-flex justify-content-center">

                            <?php if ($_GET['page'] != 1){ ?>

                            <a class="oth-pagination-jumper" href="<?= base_url('Web/article') ?>"> First </a>

                            <a class="oth-pagination-jumper" href="<?= base_url('Web/article?page=').($_GET['page'] - 1); ?>">Prev</a>

                            <?php }  ?>

                            <?php for ($i=1; $i<=$pages ; $i++){ ?>

                            <a class="page-item <?php echo ($_GET['page'] == $i) ? 'active' : ''; ?>" href="<?= base_url('Web/article?page=').$i ?>">
                                <?= $i ?>
                            </a>

                            <?php } ?>

                            <?php if ($_GET['page'] != $pages){ ?>

                            <a class="oth-pagination-jumpe" href="<?= base_url('Web/article?page=').($_GET['page'] + 1); ?>">Next</a>

                            <a class="oth-pagination-jumpe oth-pagination-jumperLast" href="<?= base_url('Web/article?page=').$pages ?>"> Last </a>

                            <?php }  ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!--  END OF WEB ONLY-->

<!-- MOBILE ONLY -->

<section class="oth-popularArticle d-md-block d-xl-none">

    <div class="container-fluid container-custom-deep">

        <div class="row">

            <div class="col-md-12">

                <div class="row" style="margin-bottom: 30px;">

                    <div class="col-md-12">

                        <?php foreach ($article as $zxc){ ?>

                            <div class="oth-popularArticle-card" style="margin-bottom:30px;">

                                <div class="row no-gutters">

                                    <div class="col-sm-12 col-md-3" style="padding-right:0px;">

                                        <img src="<?= base_url() ?>assets/article/<?= $zxc->post_picture ?>" alt="" class="img-fluid">

                                    </div>

                                    <div class="col-sm-12 col-md-9 article-card-content">

                                        <h4><a href="<?= base_url() ?>Web/post?post_id=<?= $zxc->post_id ?>" style="color:black"><?= $zxc->post_header ?></a></h4>

                                        <p class="popularArticle-card-date">
                                            <?= set_date($zxc->post_date) ?>
                                        </p>

                                        <p class="popularArticle-card-text mb-3">

                                            <?php 

                                                    $string     =   $zxc->post_content;

                                                    $string = strip_tags($string);

                                                    if (strlen($string) > 75) {

                                                        // truncate string

                                                        $stringCut = substr($string, 0, 75);

                                                        $endPoint = strrpos($stringCut, ' ');

                                                        //if the string doesn't contain any space then it will cut without word basis.

                                                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);

                                                        $string .= " ...";

                                                    }

                                                    echo $string;

                                                 ?>

                                        </p>

                                        <a href="<?= base_url() ?>Web/post?post_id=<?= $zxc->post_id ?>" class="popularArticle-card-more">Read More</a>

                                        <?php 

                                        $q = "select * from post_tag a inner join tag b on a.tag_id = b.tag_id where a.post_id = ".$zxc->post_id.' limit 1';

                                        $single_tag = $this->my_query->query($q);

                                        if ( $single_tag->num_rows() > 0) {

                                    ?>

                                            <label class="float-right oth-sorting-cat " style="background-color: <?= $single_tag->row()->tag_color; ?>;">
                                                <?php echo $single_tag->row()->tag_title  ?>
                                            </label>

                                            <?php } ?>

                                    </div>

                                </div>

                            </div>

                            <?php } ?>

                                <div class="oth-pagination d-flex justify-content-center">

                                    <?php if ($_GET['page'] != 1){ ?>

                                        <a class="oth-pagination-jumper" href="<?= base_url('Web/article') ?>"> First </a>

                                        <a class="oth-pagination-jumper" href="<?= base_url('Web/article?page=').($_GET['page'] - 1); ?>">Prev</a>

                                        <?php }  ?>

                                            <?php for ($i=1; $i<=$pages ; $i++){ ?>

                                                <a class="page-item <?php echo ($_GET['page'] == $i) ? '' : ''; ?>" href="<?= base_url('Web/article?page=').$i ?>">
                                                    <?= $i ?>
                                                </a>

                                                <?php } ?>

                                                    <?php if ($_GET['page'] != $pages){ ?>

                                                        <a class="oth-pagination-jumpe" href="<?= base_url('Web/article?page=').($_GET['page'] + 1); ?>">Next</a>

                                                        <a class="oth-pagination-jumpe oth-pagination-jumperLast" href="<?= base_url('Web/article?page=').$pages ?>"> Last </a>

                                                        <?php }  ?>

                                </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script type="text/javascript">
    $("#example-search-input").on('keyup', function(e) {

        if (e.keyCode === 13) {

            var data = $(this).val();

            window.location.href = "<?= base_url() ?>Web/search?key_search=" + data;

        }

    });

    $(document).ready(function() {

        var number = <?= $tagnumber ?>;

        for (var i = 1; i <= <?= $tagnumber ?>; i++) {

            if (i > 3) {

                $("#" + i).hide();

            }

        }

    });

    $("#alltags").click(function(event) {

        $(".mytags").fadeIn(1000);

        $(this).hide();

    });
</script>