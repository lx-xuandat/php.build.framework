<h2>Contact</h2>
<form method="post" action="/contact">
    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Enter email">
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" id="body" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
