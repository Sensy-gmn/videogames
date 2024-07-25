document.addEventListener('DOMContentLoaded', () => {
    
    const flashbag = document.querySelector('#flashbag');
    if( flashbag )
    {
        setTimeout( () => {
            flashbag.remove();
        }, 4000 );
    }
    
    const searchBar = document.querySelector('#game_search');
    
    if( searchBar )
    {
        searchBar.addEventListener('keyup', (e) => {
    
            let resultsSection = document.querySelector( '#searchResults' );
            let searchQuery = e.target.value;
            
            fetch( 'index.php?route=search&searchQuery=' + searchQuery)
            .then( res => res.json() )
            .then( games => {
                
                resultsSection.innerHTML = '';
                
                for( let g = 0; g < games.length; g++ )
                {
                    let game = games[g];
                    
                    let article = document.createElement('article');
                
                    article.style.background = "url('"+game.jacket+"')";
                    article.style.backgroundPosition = "center";
                    article.style.backgroundSize = "cover";
                    article.style.backgroundRepeat = "norepeat";
                
                    article.innerHTML = `
                        <div class="body">
                            <h3>
                                ${ game.title }
                            </h3>
                            <div>
                                <span>
                                    <i class="bi bi-calendar-event"></i> ${game.released_year}
                                </span>
                                <a href="" class="add-to-library">
                                    <i class="bi bi-bookmark-plus"></i>
                                </a>
                            </div>
                        </div>
                    `;
                    
                    resultsSection.appendChild(article);
                    
                }
                
                // console.log(results)
                
            });
    
        });
    }
})