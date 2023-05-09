<section class="recipes-section" id="recipes" aria-labelledby="recipes">
    <div class="container">

      <h1>Recipes</h1>
      <h2>You can search by coffee type or specific drink</h2>

      <!-- Search Bar -->
      <input type="search" id="search" onkeyup="mySearch()" placeholder="Search for recipe..." title="Type in a coffee type or specific drink" aria-label="search" />

      <!-- Recipe Container -->
      <div class="recipe-container">
        <!-- Recipe 1 -->
        <div class="recipe">
          <h3>Hot Coffee</h3>
          <h4>Peanut Butter Latte</h4>
        </div>
        <!-- Recipe 2 -->
        <div class="recipe">
          <h3>Cold Coffee</h3>
          <h4>Iced Coffee</h4>
        </div>
        <!-- Recipe 3 -->
        <div class="recipe">
          <h3>Dessert</h3>
          <h4>Affogato</h4>
        </div>
        <!-- Recipe 4 -->
        <div class="recipe">
          <h3>Cold Coffee</h3>
          <h4>Caramel Frappuccino</h4>
        </div>
        <!-- Recipe 5 -->
        <div class="recipe">
          <h3>Hot Coffee</h3>
          <h4>Cafe Latte</h4>
        </div>
        <!-- Recipe 6 -->
        <div class="recipe">
          <h3>Cold Coffee</h3>
          <h4>Cold Brew</h4>
        </div>
        <!-- No Results -->
        <div id="no-result" class="hide-search">No results found</div>
      </div>
    </div>
  </section>


  {{-- new --}}
    {{-- <input id="searchbar" onkeyup="search_animal()" type="text"
    name="search" placeholder="Search animals.."> --}}

<!-- ordered list -->
{{-- <ol id='list'>
    <li class="animals">Cat</li>
    <li class="animals">Dog</li>
    <li class="animals">Elephant</li>
    <li class="animals">Fish</li>
    <li class="animals">Gorilla</li>
    <li class="animals">Monkey</li>
    <li class="animals">Turtle</li>
    <li class="animals">Whale</li>
    <li class="animals">Aligator</li>
    <li class="animals">Donkey</li>
    <li class="animals">Horse</li>
</ol> --}}

{{-- New Cards --}}
<!-- search bar -->
{{-- <div class="container">
	<div class="row">
		<div class="col-sm-12 mb-3 mt-3">
			<input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Type to search..">
		</div>
	</div>
<label for="chkPassport">
    Show course reccommendations
  <input type="checkbox" id="chkPassport" />
</label> --}}
  <!-- results -->
	{{-- <div class="container" id="resultsContainer">
		<div class="row" id="myItems"> --}}
			<!-- card one -->
			{{-- <div class="col-sm-3 mt-3" id="cardOne">
				<div class="card">
					<div class="card-block">
						<img class="card-img-top img-fluid" src="//placehold.it/500x200" alt="Card image cap">
						<h5 class="card-title">Card One</h5>
						<h6 class- "card-personalityType">Subtitle</h6>
						<p class="card-text">This card has supporting text below as a natural lead-in to additional content</p>
					</div>
				</div>
			</div> --}}
			<!-- card two -->
			{{-- <div class="col-sm-3 mt-3">
				<div class="card">
					<div class="card-block">
						<img class="card-img-top img-fluid" src="//placehold.it/500x200" alt="Card image cap">
						<h5 class="card-title">Card Two</h5>
						<h6 class- "card-personalityType">Subtitle</h6>
						<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
			</div> --}}
			<!-- card six -->
			{{-- <div class="col-sm-3 mt-3">
				<div class="card">
					<div class="card-block">
						<img class="card-img-top img-fluid" src="//placehold.it/500x200" alt="Card image cap">
						<h5 class="card-title">Card Three</h5>
						<h6 class- "card-personalityType">Subtitle</h6>
						<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
			</div> --}}
			<!-- card four -->
			{{-- <div class="col-sm-3 mt-3">
				<div class="card">
					<div class="card-block">
						<img class="card-img-top img-fluid" src="//placehold.it/500x200" alt="Card image cap">
						<h5 class="card-title">Card Four</h5>
						<h6 class- "card-personalityType">Subtitle</h6>
						<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
			</div> --}}
			<!-- card five -->
			{{-- <div class="col-sm-3 mt-3">
				<div class="card">
					<div class="card-block">
						<img class="card-img-top img-fluid" src="//placehold.it/500x200" alt="Card image cap">
						<h5 class="card-title">Card Five</h5>
						<h6 class- "card-personalityType">Subtitle</h6>
						<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
			</div> --}}
			<!-- card six -->
			{{-- <div class="col-sm-3 mt-3">
				<div class="card">
					<div class="card-block">
						<img class="card-img-top img-fluid" src="//placehold.it/500x200" alt="Card image cap">
						<h5 class="card-title">Card Six</h5>
						<h6 class- "card-personalityType">Subtitle</h6>
						<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
			</div> --}}
			<!-- card seven -->
			{{-- <div class="col-sm-3 mt-3">
				<div class="card">
					<div class="card-block">
						<img class="card-img-top img-fluid" src="//placehold.it/500x200" alt="Card image cap">
						<h5 class="card-title">Card Seven</h5>
						<h6 class- "card-personalityType">Subtitle</h6>
						<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
			</div> --}}
			<!-- card eight -->
			{{-- <div class="col-sm-3 mt-3">
				<div class="card">
					<div class="card-block">
						<img class="card-img-top img-fluid" src="//placehold.it/500x200" alt="Card image cap">
						<h5 class="card-title">Card Eight</h5>
						<h6 class- "card-personalityType">Subtitle</h6>
						<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
			</div> --}}
      <!-- card nine -->
			{{-- <div class="col-sm-3 mt-3">
				<div class="card">
					<div class="card-block">
						<img class="card-img-top img-fluid" src="//placehold.it/500x200" alt="Card image cap">
						<h5 class="card-title">Card B</h5>
						<h6 class- "card-personalityType">Subtitle</h6>
						<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
			</div>
 --}}


