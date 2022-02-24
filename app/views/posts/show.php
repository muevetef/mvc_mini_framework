<?php require APPROOT . '/views/includes/header.php'; 
echo '<pre>';
var_dump($data);
echo '</pre>';
?>

<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Written by <?php echo $data->name; ?> on <?php echo $data->postCreated; ?>
</div>
<p><?php echo $data->body; ?></p>

<?php if($data->userId == $_SESSION['user_id']) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data->postId; ?>" class="btn btn-dark">Edit</a>

  <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data->postId; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
<?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>