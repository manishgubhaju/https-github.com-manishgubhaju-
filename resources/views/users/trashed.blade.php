<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="row">
       
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase mb-0"><a href="{{ route('users.create') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Add new User</a></h5>
               <?php if (Session::has('info'))
                        {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo  $value = Session::get('info');
                            echo '</div>';
                        }
                ?>
            </div>
            <div class="table-responsive">
                <table class="table no-wrap user-table mb-0" cellspacing="5" cellpadding="5">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">First Name</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Last Name</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Deleted</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = 0; ?>
                    @foreach($users as $user_info)
                    <?php $i++; ?>
                    <tr>
                      <td class="pl-4">{{ $i }}</td>
                      <td>
                          <h5 class="font-medium mb-0">{{ $user_info['firstname'] }} </h5>
                         
                      </td>
                      <td>
                          <span class="text-muted">{{ $user_info['lastname'] }}</span><br>
                          
                      </td>
                      <td>
                          <span class="text-muted">{{ $user_info['email'] }}</span><br>
                          
                      </td>
                      <td>
                          <span class="text-muted">{{ $user_info['deleted_at'] }}</span><br>
                          
                      </td>
                      
                      <td>
                        
                       <a href="{{ route('users.edit', ['id' => $user_info['id']]) }}"><button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </button> </a>
                       <a href="{{ route('users.destroy', ['id' => $user_info['id']]) }}"> <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </button>    </a>
                    </td>
                    </tr>
                    @endforeach
                   
                </table>
            </div>
        </div>
    </div>
</div>
</div>
           
        </div>
    </div>
   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



