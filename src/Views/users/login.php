<?php ob_start(); ?>
<div class="container d-flex align-item-center justify-content-center" style="min-height: calc(100vh - var(--header))">
    <form class="my-4" style="width: 400px" method="post">
      <!-- Email input -->
       <h1 class="text-center mb-4">Đăng nhập</h1>
      <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="form2Example1">Email address</label>
        <input type="email" id="form2Example1" class="form-control" name="email"/>
      </div>
    
      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="form2Example2">Password</label>
        <input type="password" id="form2Example2" class="form-control" name="password"/>
      </div>
    
      <!-- Submit button -->
       <div class="text-center">
           <button type="submit" class="btn btn-primary mb-4">Sign in</button>
       </div>
    
      <!-- Register buttons -->
      <div class="text-center">
        <p>Not a member? <a href="#!">Register</a></p>
      </div>
    </form>
</div> 
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>