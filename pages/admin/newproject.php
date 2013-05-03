<form action="/admin/newprojectx" id="editpage" method="POST" enctype="multipart/form-data">
    <h3>Project Title: <input type="text" name="title" id="title"></h3>
    <h3>Default Image: <input type="file" name="file"></h3>
    <table id="team_members">
        <tr><td><h3>Other team member: </h3><input type="hidden" name="cuid_0" id="cuid_0"></td><td><input type="text" id="member_0" class="query"></td><td><img class="addrow" src="/img/plus.png"></td></tr>
    </table>
    <input type="hidden" id="spooler">
    <div class="editorlocation">
    	<h3>Project Page Content (include 50+ words and other pics if applicable):</h3>
        <p>To upload a photo, or any other file, click on the "Insert" tab below.</p>
        <textarea id="page" name="page"></textarea>
    </div>
    <input type="submit" value="Submit" class="prettybutton">
</form>