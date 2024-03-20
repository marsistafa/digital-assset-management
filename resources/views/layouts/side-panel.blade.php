
<div class="side-panel">
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('files.index') }}">My Files</a></li>
        <li><a href="{{ route('files.create') }}">Upload Files</a></li>
        <li><a href="{{ route('categories.index') }}">Groups</a></li>
        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
    </ul>
</div>
<style>
    /* public/css/styles.css */

.side-panel {
    width: 200px;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #333;
    color: #fff;
}

.side-panel ul {
    list-style: none;
    padding: 10px;
}

.side-panel li {
    margin-bottom: 10px;
}

.side-panel a {
    text-decoration: none;
    color: #fff;
}
</style>