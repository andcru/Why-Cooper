<h1>Alumnus Registration Page</h1>

<form method="POST" action="/registerx">
<table>
	<tr>
		<td>First Name: </td>
		<td><input type="text" name="fname"></td>
	</tr>
	<tr>
		<td>Last Name: </td>
		<td><input type="text" name="lname"></td>
	</tr>
	<tr>
		<td>Cooper Graduation Year: </td>
		<td><input type="text" name="year"> (1900 - 2011)</td>
	</tr>
	<tr>
		<td>Major: </td>
		<td>
			<select name="major">
				<option value="0">Select...</option>
				<option value="11">Chemical Engineering</option>
				<option value="21">Civil Engineering</option>
				<option value="31">Electrical Engineering</option>
				<option value="41">Mechanical Engineering</option>
				<option value="51">Interdisciplinary Engineering</option>
				<option value="61">Art</option>
				<option value="71">Architecture</option>
				<option value="81">Physics</option>
			</select>
		</td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
		<td>Desired Username: </td>
		<td><input type="text" name="cuid"> (3-7 characters)</td>
	</tr>
	<tr>
		<td>Email Address: </td>
		<td><input type="text" name="email"></td>
	</tr>
	<tr>
		<td>Create Password: </td>
		<td><input type="password" name="pass1"></td>
	</tr>
	<tr>
		<td>Password (confirm): </td>
		<td><input type="password" name="pass2"></td>
	</tr>
</table>
<input type="Submit" value="Submit">