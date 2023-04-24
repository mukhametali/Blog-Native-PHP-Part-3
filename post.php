<?php
require_once 'database/pdo.php';

$postId = $_GET['id'];
$articleSelect = $pdo->prepare("SELECT * FROM posts WHERE id =:id");
$articleSelect->execute([
        ':id' => $postId
]);
$article = $articleSelect->fetch(PDO::FETCH_ASSOC);
$commentsSelect = $pdo->prepare("SELECT * FROM comments WHERE post_id = :id");
$commentsSelect->execute([
        'id' => $postId
]);
$comments = $commentsSelect->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__ . "/includes/head.php";?>
    <body>
    <?php include_once __DIR__ . "/includes/navigation.php";?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('<?=$article['image']?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?=$article['title']?></h1>
                            <h2 class="subheading"><?=$article['subtitle']?></h2>
                            <span class="meta">
                                Posted by
                                <a href="#!"><?=$article['author_name']?></a>
                                <?=$article['created_at']?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7"><?= $article['body']?></div>
                </div>
            </div>
        </article>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <h2>Comments</h2>
                    <?php
                    foreach ($comments as $comment)
                    {
                        ?>
                        <div class="post-preview">
                            <a href="#">
                                <h2 class="post-title"><?=$comment['author_name']?></h2>
                                <h3 class="post-subtitle"><?=$comment['body']?></h3>
                            </a>
                        </div>
                    <?php
                    }
                    ?>

                    <hr class="my-4">
                </div>
            </div>
        </div>
        <section class="comments mb-4">
            <div class="container px-4 px-lg-5">
                <div class="col-md-10 col-lg-8 col-xl-7"><form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="form-floating">
                        <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                        <label for="name">Name</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" id="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                        <label for="message">Message</label>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                    </div>
                    <br />
                    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </section>

        <?php include_once __DIR__ . "/includes/footer.php";?>
    <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
