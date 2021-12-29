<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>eBis :: Refresh Application</title>
</head>
<body style="margin: 0px">
<form method="post">
  @csrf
  <div class="main" style="width:360px; height: 100vh; margin: 0px auto; display: flex; flex-direction: column; justify-content: center">
    <select name="type" style="padding: 10px; margin: 3px 0px; background-color: #21BA45; font-weight: bold; color: white; border: 1px solid #DDD; border-radius: 5px">
      <option value="restore">Backup, Flush, Install then Restore from Backup</option>
      <option value="fresh">Flush all and Install with Default, then restore client data</option>
    </select>
    <select name="speed" style="padding: 10px; margin: 3px 0px; background-color: #21BA45; font-weight: bold; color: white; border: 1px solid #DDD; border-radius: 5px">
      <option value="1000000">Restore Speed - 1 Records/Sec</option>
      <option value="100000">Restore Speed - 10 Records/Sec</option>
      <option value="10000" selected>Restore Speed - 100 Records/Sec</option>
      <option value="1000">Restore Speed - 1000 Records/Sec</option>
      <option value="100">Restore Speed - 10000 Records/Sec</option>
      <option value="10">Restore Speed - 100000 Records/Sec</option>
      <option value="1">Restore Speed - 1000000 Records/Sec</option>
      <option value="0">Restore Speed - Full Speed</option>
    </select>
    <input type="submit" name="submit" value="PROCEED" style="padding: 10px 0px; margin-top: 10px; background-color: #21BA45; border: 3px solid #21BA45; border-radius: 25px; color: white; font-weight: bolder;" />
  </div>
</form>
</body>
</html>
