<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>The HTML5 Herald</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <link rel="stylesheet" href="">
</head>
<body>
    <img src="{{ asset('images/logo.png') }}">
    <p>
        Je bent uitgenodigd voor registratie van Futsal Club Heerenveen!</br>
    </p>
    <table cellspacing="0" border="0" cellpadding="0" width="240">
        <tr>
            <td height="35" bgcolor="#f44336" style="border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; -khtml-border-radius: 5px; font-size: 16px; font-family: sans-serif; color: #333333; margin: 0; padding: 0; text-align: center;" class='vero-editable'><a href="{{ $register_url }}" style="font-weight:bold; text-decoration:underline;color: #ffffff;text-decoration:none;">Registreren &rarr;</a></td>
        </tr>
    </table>
    <p><i>Of klik op deze link: <a href="{{ $register_url }}">{{ $register_url }}</a>
</body>
</html>
