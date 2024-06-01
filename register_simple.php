<?php
include "lib/config.php";
include "lib/header.php";
?>

<!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
  <div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold" style="margin-top: 10px;">
    <div class="container" >
      <div class="c-page-title c-pull-left" >
        <h2 class="c-font-bold">Register</h2>
      </div>
      <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
        <li>
          Welcome to the IPEG Family! Register now for a bright career ahead.
        </li>
      </ul>
    </div>
  </div>
  <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->

 <div class="c-content-box c-size-md">
  <div class="container">
     <div id="filters-container" class="cbp-l-filters-button">
      <?php
      if(isset($_GET['msg']))
        print "<BR><B>".$_GET['msg']."</B><BR><BR>";
      ?>

      <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
        .input-error {
            border-color: red;
        }
        .password-strength {
            display: block;
            height: 5px;
            margin-top: 5px;
            background-color: red;
        }
    </style>
    <script type="text/javascript">
        function verify() {
            let valid = true;

            const fullname = document.rForm.fullname;
            const password = document.rForm.password;
            const confirm_password = document.rForm.confirm_password;

            // Clear previous errors
            clearErrors();

            // Validate fullname
            if (fullname.value.trim() === "") {
                showError(fullname, 'Please enter your name');
                valid = false;
            }

            // Validate password
            if (!validatePassword(password.value)) {
                showError(password, 'Password must be at least 6 characters with uppercase, lowercase, and special characters.');
                valid = false;
            }

            // Validate confirm password
            if (password.value !== confirm_password.value) {
                showError(confirm_password, 'Password and Confirm Password do not match');
                valid = false;
            }

            return valid;
        }

        function showError(element, message) {
            const error = document.createElement('div');
            error.className = 'error';
            error.innerText = message;
            element.classList.add('input-error');
            element.parentNode.appendChild(error);
        }

        function clearErrors() {
            const errors = document.querySelectorAll('.error');
            errors.forEach(error => error.remove());
            const inputs = document.querySelectorAll('.input-error');
            inputs.forEach(input => input.classList.remove('input-error'));
        }

        function validatePassword(password) {
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{6,}$/;
            return regex.test(password);
        }

        function updatePasswordStrength() {
            const password = document.rForm.password.value;
            const strengthBar = document.getElementById('passwordStrength');
            const strength = calculatePasswordStrength(password);
            strengthBar.style.backgroundColor = strength.color;
        }

        function calculatePasswordStrength(password) {
            const strength = {color: 'red'};
            const lengthCriteria = password.length >= 6;
            const uppercaseCriteria = /[A-Z]/.test(password);
            const lowercaseCriteria = /[a-z]/.test(password);
            const specialCharacterCriteria = /[\W]/.test(password);

            if (lengthCriteria && uppercaseCriteria && lowercaseCriteria && specialCharacterCriteria) {
                strength.color = 'green';
            } else if (lengthCriteria && (uppercaseCriteria || lowercaseCriteria) && specialCharacterCriteria) {
                strength.color = 'orange';
            } else if (lengthCriteria) {
                strength.color = 'yellow';
            }
            return strength;
        }
    </script>


    <form action="register_simple_response" name="rForm" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="return verify();">
        <div class="form-group">
            <label for="fullname" class="col-md-4 control-label">Full Name *</label>
            <div class="col-md-6">
                <input type="text" class="form-control c-square c-theme" id="fullname" name="fullname" placeholder="Your Full Name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="gender" class="col-md-4 control-label">&nbsp;</label>
            <div class="col-md-6">
                <table>
                    <tr>
                        <td>Select Gender</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Male&nbsp;</td>
                        <td><input type="radio" name="gender" value="Male" required></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female&nbsp;</td>
                        <td><input type="radio" name="gender" value="Female" required></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-4 control-label">Email *</label>
            <div class="col-md-6">
                <input type="email" name="email" class="form-control c-square c-theme" id="email" placeholder="Email" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-md-4 control-label">Password *</label>
            <div class="col-md-6">
                <input type="password" name="password" class="form-control c-square c-theme" id="password" placeholder="Password" minlength="6" required oninput="updatePasswordStrength()">
                <div id="passwordStrength" class="password-strength"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="confirm_password" class="col-md-4 control-label">Confirm Password *</label>
            <div class="col-md-6">
                <input type="password" name="confirm_password" class="form-control c-square c-theme" id="confirm_password" placeholder="Confirm Password" minlength="6" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-6">
                <input type="submit" name="btnsubmit" value="Quick Register" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">
            </div>
        </div>
    </form>


    </div>
  </div>
</div>    


<?php
include "lib/footer.php";
?>