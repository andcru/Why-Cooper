<form action="/admin/newprojectx" id="editpage" method="POST" enctype="multipart/form-data">
    <h3>Project Title: <input type="text" name="title" id="title"></h3>
    <h3>Default Image: <input type="file" name="file"></h3>
    <h3>Other team members: <input type="text" name="members"></h3>
    <input type="hidden" id="spooler">
    <div class="editorlocation">
    	<h3>Project Page Content: (include 100+ words and other pics if possible)</h3>
        <textarea id="page" name="page"></textarea>
    </div>
    <input type="submit" value="Submit" class="prettybutton">
</form>