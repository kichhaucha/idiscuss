<!-- Modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupmodalLabel">signup for an idiscuss acount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/pars/handlesignup.php" method="POST">
            <div class="modal-body">
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">username</label>
                        <input type="text" class="form-control" id="signupemail" name="signupemail" aria-describedby="emailHelp">
                     
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signuppassword" name="signuppassword">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">conform-Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                

                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             
            </div>
            </form>
        </div>
    </div>
</div>