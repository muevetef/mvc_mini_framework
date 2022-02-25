<?php require APPROOT . '/views/includes/header.php'; ?>

  
    <h2>Contacta con nosotros</h2>

    <form action="<?php echo URLROOT; ?>/pages/contact" method="post">
      <div class="form-group">
        <label for="asunto">Asunto: <sup>*</sup></label>
        <input type="text" name="asunto" class="form-control form-control-lg <?php echo (!empty($data['asunto_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['asunto']; ?>">
        <span class="invalid-feedback"><?php echo $data['asunto_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="msg">Mensage: <sup>*</sup></label>
        <textarea name="msg" class="form-control form-control-lg <?php echo (!empty($data['msg_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['msg']; ?></textarea>
        <span class="invalid-feedback"><?php echo $data['msg_err']; ?></span>
      </div>
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>