<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href=" {{asset('css/app.css')}} ">
	<link rel="bootstrap" href=" {{asset('bootstrap/')}} ">
	<style>
		.list-group {
			overflow-y: scroll;
			height: 200px;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="row d-flex justify-content-center" id="app">
			<div class="offser-4 col-4">
				<li class="list-group-item active">Chat Room</li>
				<ul class="list-group" v-chat-scroll>
					<message v-for="value, index in chat.message" :key="value.index" :color=chat.color[index] :user = chat.user[index]>
						@{{value}}
					</message>
				</ul>
				<input type="text" class="form-control" placeholder="Type a message" v-model="message" @keyup.enter='send'>
			</div>
		</div>
	</div>

	<script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>