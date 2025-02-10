<style>
    form {
        padding: 1em;
    }
</style>
<form method="POST" action="/send_connect">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">User</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>