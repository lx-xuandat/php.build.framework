<h2>Register</h2>
<form action="/register" method="post">

   <div class="form-row">
       <div class="form-group col">
           <label for="firstname">First name</label>
           <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First name">
       </div>

       <div class="form-group col">
           <label for="lastname">Last name</label>
           <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last name">
       </div>
   </div>

    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>

    <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>
