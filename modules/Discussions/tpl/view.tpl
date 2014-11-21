{if (isset($discussion->titre)) }
    <h1>{$discussion->titre}</h1>
    <h5>par : {$auteur->pseudo}</h5>

    {foreach from=$messages item=m}
        <div class="message">
            <div class="auteur">
                <p>
                    <a href="?module=Utilisateur&action=view&id={$m->id_aut_mes}">{$m->pseudo_mes}</a> écrit :
                </p>
            </div>
            <div class="ContenuMessage">
                {$m->message}
            </div>
        </div>
    {foreachelse}
        <h5>Aucun message trouvé</h5>
    {/foreach}

    {$form}
{else}
    <h1>Le sujet que vous avez demandé n'existe pas (ou plus)</h1>
{/if}