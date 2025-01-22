@can('update', $role)
    <!-- Kod paparan HTML -->
@elsecan('create', App\Models\Role::class)
    <!-- Kod paparan HTML -->
@else
    <!-- . . . . -->
@endcan


 
@cannot('update', $role)
    <!-- Kod paparan HTML -->
@elsecannot('create', App\Models\Role::class)
    <!-- Kod paparan HTML -->
@endcannot


@canany(['update', 'view', 'delete'], $role)
    <!-- Kod paparan HTML -->
@elsecanany(['create'], \App\Models\Role::class)
    <!-- Kod paparan HTML -->
@endcanany



@if (Auth::user()->can('update', $post))
    <!-- The current user can update the post... -->
@endif
 
@unless (Auth::user()->can('update', $post))
    <!-- The current user cannot update the post... -->
@endunless