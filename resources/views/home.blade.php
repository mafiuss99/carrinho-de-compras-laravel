@extends('layout')
@section('pagina_titulo', 'Home')

@section('pagina_conteudo')


		<section class="section banner-principal-home" id="banner-principal" style="background-image: url('img/banners/principal-home.png')">
			<img src="img/pixel-hacker.png" alt="">
		</section>


		<section class="section" id="lancamentos">
			<!-- container -->
			<div class="container">
				<h3 class="title text-center">Lançamentos</h3>

				<p class="text-center">
					Os principais filmes recém saídos do cinema estão aqui, escolha o seu e divirta-se
				</p>
				<!-- row -->
				<div class="row">
					@foreach($lancamentos as $lancamento)
						<div class="col-md-3">
							<div class="product"  style="width: 263px;">
								<div class="product-img">
									<img src="{{ $lancamento->capa }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category"></p>
									<h3 class="product-name"><a href="{{ route('produto', $lancamento->id) }}" tabindex="-1">{{ $lancamento->titulo }}</a></h3>
									<h4 class="product-price">R$ {{ number_format($lancamento->valor, 2, ',', '.' )}}<del class="product-old-price">R$ {{ number_format($lancamento->valor, 2, ',', '.' )}}</del></h4>
									<!--<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o"></i>
										</div>-->
										<!--<div class="product-btns">
										<button class="add-to-wishlist" tabindex="-1"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
										<button class="add-to-compare" tabindex="-1"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
										<button class="quick-view" tabindex="-1"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>-->
								</div>
								
								<div class="add-to-cart">
									<form action="{{ route('carrinho.adicionar') }}" method="POST">
										{{ csrf_field() }}
										<input type="hidden" name="id" value="{{ $lancamento->id }}">
										<button class="add-to-cart-btn" tabindex="-1"><i class="fa fa-shopping-cart" type="submit"></i>Adicionar ao carrinho</button>
									</form>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>

		<div class="section" id="generos">
			<!-- container -->
			<div class="container">
				<h3 class="text-center title">Gêneros</h3>
				<p class="text-center text-white">
					De Aventura a Terror, de Romance à Comédia, aqui temos todos os tipos de gêneros para todos os tipos de gostos
				</p>
				<!-- row -->
				<div class="row">
					<!-- shop -->
				@foreach($generos as $genero)
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="{{ $genero->imagem }}" alt="">
							</div>
							<div class="shop-body">
								<h3>{{ $genero->nome }}</h3>
								<a href="#" class="cta-btn">Ver Filmes<i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				@endforeach
				</div>
				<!-- /row -->

				<a href="#">Ver Todos</a>
			</div>
			<!-- /container -->
		</div>

        <section class="section" id="destaques">
			<!-- container -->
			<div class="container">
				<h3 class="title text-center">Filmes Mais buscados</h3>
				<p class="text-center"> 
					Os filmes que todos estão buscando...
				</p>
				<!-- row -->
				<div class="row">
					@foreach($destaques as $destaque)
						<div class="col-md-3">
							<div class="product"  style="width: 263px;">
								<div class="product-img">
									<img src="{{$destaque->capa}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category"></p>
									<h3 class="product-name"><a href="{{ route('produto', $destaque->id) }}" tabindex="-1">{{ $destaque->titulo }}</a></h3>
									<h4 class="product-price">R$ {{ number_format($destaque->valor, 2, ',', '.' )}}<del class="product-old-price">R$ {{ number_format($destaque->valor, 2, ',', '.' )}}</del></h4>
									<!--<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o"></i>
										</div>-->
										<!--<div class="product-btns">
										<button class="add-to-wishlist" tabindex="-1"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
										<button class="add-to-compare" tabindex="-1"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
										<button class="quick-view" tabindex="-1"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>-->
								</div>
								
								<div class="add-to-cart">
									<form action="{{ route('carrinho.adicionar') }}" method="POST">
										{{ csrf_field() }}
										<input type="hidden" name="id" value="{{ $destaque->id }}">
										<button class="add-to-cart-btn" tabindex="-1"><i class="fa fa-shopping-cart" type="submit"></i>Adicionar ao carrinho</button>
									</form>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>


		<!--<section class="section" id="propaganda">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<img src="img/propaganda/back-to-te-future-box.jpg" alt="" width="70%">
					</div>
				</div>
			</div>
		</section>-->

		<section class="section" id="estudios">
			<!-- container -->
			<div class="container">
				<h3 class="title text-center">Principais Estúdios</h3>
				<p class="text-center text-black-50"> 
					Aqui você encontra os filmes dos principais estudios de cinema do mundo como a Warner, Universal, Sony, Paramount e outras...
				</p>
				<!-- row -->
				<div class="row">
					@foreach($estudios as $estudio)
						<div class="col-md-3">
							<a href="">
								<img src="{{ $estudio->logo }}" alt="" width="200px">
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</section>

		<section class="section" id="sociais">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<img src="img/stormtrooper.png" alt="" width="60%">
					</div>
					<div class="col-md-6">
						<div class="bloco-sociais">
							<span>PARADO AÍ</span>
							<p>
								Ainda não segue o Cine Store nas Redes Sociais? 
							Melhor você fazê-lo, se não vai ter que se explicar para o Imperador...
							</p>
						</div>
						
					</div>
				</div>
			</div>
		</section>

@endsection