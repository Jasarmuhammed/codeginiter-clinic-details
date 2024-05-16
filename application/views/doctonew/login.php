
<body>
    <div class="login-container">
        <h2>Login</h2>
  <?php echo form_open('Doctologin/login_form'); ?>
            <div class="form-group">

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
  
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
            <?php echo form_close(); ?>

    </div>
</body>
</html>
