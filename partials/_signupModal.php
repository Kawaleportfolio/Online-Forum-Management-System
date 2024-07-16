<script>
    let cdisabled ;
    let disabled ;
function cpass_validate() {
            let pass = document.getElementById('password').value;
            let cpass = document.getElementById('cpassword').value;
            

            if (pass !== cpass) {
                document.getElementById('wrong_pass_alert').style.color = 'red';
                document.getElementById('wrong_pass_alert').innerHTML = '☒ Please enter the same password';
                cdisabled = true;
                // document.getElementById('sbtn').style.opacity = 0.4;
            } else {
                document.getElementById('wrong_pass_alert').style.color = 'green';
                document.getElementById('wrong_pass_alert').innerHTML = '🗹 Passwords match';
                cdisabled = false;
                // document.getElementById('sbtn').style.opacity = 1;
            }
            updateSignupButtonState()
        }

        function validatePasswordCriteria() {
            let pass = document.getElementById('password').value;
            if (pass.length < 8 || !/[A-Z]/.test(pass) || !/[a-z]/.test(pass) || !/[0-9]/.test(pass) || !/[@$!%*?&]/.test(pass)) {
                document.getElementById('chk_alert').style.color = 'red';
                document.getElementById('chk_alert').innerHTML = '☒ Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one special character';
                disabled = true;
                // document.getElementById('sbtn').style.opacity = 0.4;
            } else {
                document.getElementById('chk_alert').innerHTML = '';
                disabled = false;
                // document.getElementById('sbtn').style.opacity = 1;
            }
            updateSignupButtonState()
        }


        function updateSignupButtonState() {
        if (disabled || cdisabled) {
            document.getElementById('sbtn').disabled = true;
            document.getElementById('sbtn').style.opacity = 0.4;
        } else {
            document.getElementById('sbtn').disabled = false;
            document.getElementById('sbtn').style.opacity = 1;
        }
    }

        function pass_visibility() {
            let pass = document.getElementById('password');
            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        }
</script>

<!-- Modal -->
<div class="modal fade" id="signupModa" tabindex="-1" aria-labelledby="signupModaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signupModaLabel">Signup for an iDiscuss account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="partials/handlesSignup.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" onkeyup="validatePasswordCriteria()" required>
                        <span id="chk_alert"></span>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="showPassword" onclick="pass_visibility()">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" onkeyup="cpass_validate()" required>
                        <span id="wrong_pass_alert"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="sbtn" type="submit" class="btn btn-primary" disabled>Signup</button>
                </div>
            </form>
        </div>
    </div>
</div>