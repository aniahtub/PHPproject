@extends('layouts.app')
@section('title')
Todos list
@endsection
@section('content')
<h1 class="text-center my-4" style="text-shadow:0 0.3rem 0.5rem rgb(0 0 0 / 30%);">Create New Todo</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-default my-4">
            <div class="card-header">
                Create new Todo
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                        <li class="list-group-item">
                            {{$error}}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('store')}}" method="post" onsubmit="event.preventDefault();subTodo();" id="todoForm">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                aria-describedby="helpId">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="reminder" class="form-control" placeholder="Reminder" id="reminder"
                             onchange="remind()"  onfocus="(this.type='time')" aria-describedby="helpId" >
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="description" id="5" rows="5"
                            placeholder="Description"></textarea>
                    </div>
                    <div class="form-group text-center m-0">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card card-default">
            <div class="card-header">
                Todos
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php $count=0; ?>
                    @foreach ($todos as $todo)
                    <li class="list-group-item {{($todo->priority!=null)?'bg-success':' '}} ">
                        {{$todo->name}}
                        @if ($todo->completed)
                        <a href="#" class="btn btn-outline-warning btn-sm float-right">Completed</a>
                        @endif
                        <a href="{{route('destroy',$todo->id)}}" class="btn btn-sm btn-danger float-right mr-2">Delete</a>
                        <a href="{{route('edit',$todo->id)}}" class="btn btn-sm btn-info float-right mr-2">Edit</a>
                        <a href="{{route('show',$todo->id)}}" class="btn btn-primary btn-sm float-right mr-2">View</a>
                        @if ($todo->priority!=null)
                        <a href="{{route('remPriority',$todo->id)}}" class="btn btn-light btn-sm float-right mr-2">Remove Priority</a>
                        <a href="{{route('priority',$todo->id)}}" class="btn btn-light btn-sm float-right mr-2">Set Priority</a>
                        <button class="btn btn-outline-warning  btn-sm float-right mr-2">{{++$count}} Priority</button>
                        @else
                        <a href="{{route('priority',$todo->id)}}" class="btn btn-light btn-sm float-right mr-2">Set Priority</a>
                        @endif
                        @if ($todo->reminder<now()->toTimeString()&&$todo->completed==0)
                        <button class="btn btn-outline-danger btn-sm float-right mr-2">Missing Reminder</button>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    remValue=document.getElementById('reminder').value   
    $todos= {!! json_encode($todos->toArray()) !!}
    const currentTimenow = new Date().toLocaleTimeString('en',
                 { timeStyle: 'short', hour12: false,});
    console.log($todos)
    console.log(currentTimenow)
    var todosSize=0;
    var todosArray=[];
    for(key in $todos)
    {
        if ($todos.hasOwnProperty(key)) todosSize++;
    }
    for (let i = 0; i < todosSize; i++) {
        todosArray.push($todos[i]);
    }
    console.log(todosArray)
    $todos=todosArray;
    $reminders=[]
    $todos.forEach(element => {
        if(element['reminder']!=null&&element['completed']!=1&&element['reminder']>currentTimenow)
        {
        $reminders.push(element['reminder'])
        }
    });
    $reminders=$reminders.sort();
    console.log($reminders)

    function remind(){
        remValue=document.getElementById('reminder').value
        var today=new Date()
        var remTime=new Date()
        remValue=remValue.split(":");
        remTime.setHours(remValue[0]);
        remTime.setMinutes(remValue[1]);
        remTime.setSeconds(0);
        today.setSeconds(0);
        remTime=remTime.getTime()
        today=today.getTime()
        if(remTime<=today)
        {
        alert('Given time is not valid');
        }

    }

    function subTodo(){
        remValue=document.getElementById('reminder').value
        var today=new Date()
        var remTime=new Date()
        remValue=remValue.split(":");
        remTime.setHours(remValue[0]);
        remTime.setMinutes(remValue[1]);
        remTime.setSeconds(0);
        today.setSeconds(0);
        remTime=remTime.getTime()
        today=today.getTime()

        if(remTime<=today)
        {
        alert('Given time is not valid');
        }
        else{
            var verify=false;
            $reminders.forEach(element => {
              var item=new Date();
              element=element.split(":");
              item.setHours(element[0]);
              item.setMinutes(element[1]);
              item.setSeconds(0);
              item=item.getTime();
              if(item==remTime)
                {
                    alert('Given time is inserted')
                    verify=true;
                }
            });
            if(verify==false)
            {
                document.getElementById("todoForm").submit();
            }
        }
    }
    $reminders.forEach(element => {
        var item=new Date();
   
        element=element.split(":");
        item.setHours(element[0]);
        item.setMinutes(element[1]);
        item.setSeconds(0);
        // item=item.getTime();
        const itemlatest = new Date(item).toLocaleTimeString('en',
                 { timeStyle: 'short', hour12: false, timeZone: 'UTC' });
                 console.log(itemlatest)
        var inter=setInterval(() => {
                console.log('hii')
            var today=new Date()
            today.setSeconds(0);
            // today=today.getTime()
            const todaylatest = new Date(today).toLocaleTimeString('en',
                 { timeStyle: 'short', hour12: false, timeZone: 'UTC' });
            console.log(todaylatest)
            console.log(itemlatest)
            if(todaylatest==itemlatest)
            {
                $todos.forEach(e => {
                    if(e.reminder!=null)
                    {
                            var todo=new Date();
                        console.log(e.reminder)
                        var task=e.reminder.split(":");
                        todo.setHours(task[0]);
                        todo.setMinutes(task[1]);
                        todo.setSeconds(0);
                        // todo=todo.getTime();
                        const todolatest = new Date(todo).toLocaleTimeString('en',
                        { timeStyle: 'short', hour12: false, timeZone: 'UTC' });
                        if(todolatest==itemlatest)
                        {
                            clearInterval(inter)
                            alert('Its time to do "'+e.name+'" Todo!')
                            // swal("Do your job!", 'Its time to do "'+e.name+'" Todo!', "warning");
                            let url = "{{ route('complete',':id') }}";
                            url = url.replace(':id',e.id);
                            console.log(url)
                            document.location.href=url;
                        }
                    }
                });
            }

        },1000);
              
    });
   
</script>
@endsection