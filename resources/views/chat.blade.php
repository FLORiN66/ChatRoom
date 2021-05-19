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
			<div class="offser-4 col-4 offset-sm-1 col-sm-10">
				<li class="list-group-item active">Chat Room<span class="badge badge-pill badge-warning">@{{numberOfUsers}}</span></li>
				<div class="badge badge-pill badge-primary">@{{typing}}</div>
				<ul class="list-group" v-chat-scroll>
					<message v-for="value, index in chat.message" :key="value.index" :color=chat.color[index] :user = chat.user[index] :time = chat.time[index]>
						@{{value}}
					</message>
				</ul>
				<input type="text" class="form-control" placeholder="Type a message" v-model="message" @keyup.enter='send'>
				<a href='' class="btn btn-warning btn-sm mt-3" @click.prevent='deleteSession'>Delete Chat</a>
			</div>
		</div>
	</div>

	<script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>