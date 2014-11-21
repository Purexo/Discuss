{if (isset($form)) }
    <h1>Vous avez mal remplis le formulaire</h1>
    {$form}
{else}
    <h1>Félicitation, Formulaire remplis avec succès</h1>
{/if}