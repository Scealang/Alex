package Application;

// Импорт классов
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

// Класс создания и взаимодействия с расписанием
public class TimetableSystem
{
    // Объявление полей класса
    User admin; // Администратор системы
    List<User> users; // Список пользователей
    ArrayList<Request> requests; // Список заявок
    User currentUser; //Текщий пользователь
    int roomcount; // Количество аудиторий
    final int pairsinday = 5; //Количество пар в день в университете
    final int workdays = 6; // Количество рабочих дней
    Request[][][] schedue; // Расписание преподавателя

    // Конструктор класса
    public TimetableSystem()
    {
        roomcount=0;
        users = new ArrayList<User>();
        requests = new ArrayList<Request>();
        admin = new User("admin","admin","admin");
        users.add(admin);
    }

    // Метод добавления нового пользователя в список существующих пользователей
    public void addUser(String name, String login, String password)
    {
        User newuser = new User(name, login, password);
        this.users.add(newuser);
        System.out.println("Вы успешно зарегистрировались");
    }

    // Метод добавления новой заявки
    public void addRequest(User currentUser,String discipline, int group, int pairsinweek )
    {
        Request newrequest = new Request(currentUser,discipline, group,pairsinweek);
        requests.add(newrequest);
    }

    // Метод входа в систему
    public void loginSystem()
    {
        boolean flag=false;
        Scanner input = new Scanner(System.in);
        System.out.println("Введите логин");
        String login = input.nextLine();
        System.out.println("Введите пароль");
        String password = input.nextLine();
        for (User currentUser: users)
        {
            if (currentUser.enter(login,password))
            {
                this.currentUser = currentUser;
                userInterface(currentUser);
                flag = true;
            }
        }
        if (flag==false)
        {
            System.out.println("Неправильный логин или пароль");
        }
    }

    // Метод вывода меню пользователя
    public void userMenu()
    {
        System.out.println("Меню пользователя");
        System.out.println("1 Подать заявку");
        System.out.println("2 Посмотреть расписание");
        System.out.println("3 Повторно показать меню");
        System.out.println("0 Выйти из системы");
    }

    // Метод вывода меню администратора
    public void adminMenu()
    {
        System.out.println("Меню администратора");
        System.out.println("1 Ввести количество аудиторий");
        System.out.println("2 Создать расписание");
        System.out.println("3 Повторно показать меню");
        System.out.println("0 Выйти из системы");
    }

    // Метод установки администратором количества свободных аудиторий
    public int setRoom()
    {
        System.out.println("Введите количество свободных аудиторий");
        Scanner input = new Scanner(System.in);
        roomcount = input.nextInt();
        return roomcount;
    }

    // Метод создания расписания
    public Request[][][] makeSchedue(ArrayList<Request> requests, Request[][][] schedue,int roomcount,int workdays,int pairsinday)
    {
        if (roomcount!=0)
        {
            schedue = new Request[workdays][pairsinday][roomcount];
            int temp = 0;
            for (Request request : requests) {
                temp = 0;
                for (int tempday = 0; tempday < workdays; tempday++)
                {
                    for (int temppair = 0; temppair < pairsinday; temppair++)
                    {
                        if (temp < request.getPairsinweek()) {
                            if (!request.requester.isAcess()) {
                                request.requester.changeAcess();
                            }
                            for (int temproom = 0; temproom < roomcount; temproom++)
                            {
                                if (schedue[tempday][temppair][temproom] != null)
                                {
                                    if (schedue[tempday][temppair][temproom].getRequester() == request.getRequester() | schedue[tempday][temppair][temproom].getGroup() == request.getGroup())
                                    {
                                        request.requester.changeAcess();
                                    }
                                }
                                if (request.requester.isAcess() && schedue[tempday][temppair][temproom] == null)
                                {
                                    schedue[tempday][temppair][temproom] = request;
                                    request.requester.changeAcess();
                                    temp++;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            System.out.println("Расписание успешно создано!");
            return schedue;
        }
        else
            System.out.println("Вы не ввели количество аудиторий");
            return schedue;
    }

    // Метод вывода расписания преподавателю
    public void showTimetable(User currentUser)
    {
        if (schedue!=null)
        {
            for (int tempday = 0; tempday < workdays; tempday++)
            {
                String day = "";
                switch (tempday) {
                    case 0:
                        day = "понедельник";
                        break;
                    case 1:
                        day = "вторник";
                        break;
                    case 2:
                        day = "среду";
                        break;
                    case 3:
                        day = "четверг";
                        break;
                    case 4:
                        day = "пятницу";
                        break;
                    case 5:
                        day = "субботу";
                        break;
                }
                System.out.println("Расписание на " + day + ":");
                for (int temppair = 0; temppair < pairsinday; temppair++)
                {
                    for (int temproom = 0; temproom < roomcount; temproom++)
                    {
                        if (schedue[tempday][temppair][temproom] != null)
                        {
                            if (currentUser.getName().equals(schedue[tempday][temppair][temproom].requester.getName()))
                            {
                                System.out.println((temppair + 1) + " пара - аудитория " + (temproom + 1) + ", группа: " + schedue[tempday][temppair][temproom].getGroup() + ", предмет: " + schedue[tempday][temppair][temproom].getDiscipline());
                            }
                        }
                    }
                }
                System.out.println();
            }
        }
        else
        System.out.println("Расписание еще не составлено");
    }

    // Метод интерфейса системы
    public void userInterface(User currentUser)
    {
        int command;
        Scanner input = new Scanner(System.in);
        if (currentUser.getName().equals("admin"))
        {
            adminMenu();
            do
            {
                System.out.println("\nВведите команду");
                command = input.nextInt();
                switch (command)
                {
                    case 1:
                        roomcount=setRoom();
                        break;
                    case 2:
                        schedue = makeSchedue(this.requests,this.schedue,roomcount,workdays,pairsinday);
                        break;
                    case 3:
                        adminMenu();
                        break;
                    case 0:
                        System.out.println("Вы успешно вышли из системы\n");
                        Lab3.outputMenu();
                        break;
                     default:
                        System.out.println("Введена недопустимая команда!");
                }
            }while (command!=0);
        }
        else
        {
            userMenu();
            do
            {
                System.out.println("\nВведите команду");
                command = input.nextInt();
                switch (command)
                {
                    case 1:
                        System.out.print("Введите название дисциплины\n");
                        String discipline = input.next();
                        System.out.println("Введите номер группы");
                        int group = input.nextInt();
                        System.out.println("Введите количество пар в неделю");
                        int pairsinweek = input.nextInt();
                        addRequest(currentUser,discipline,group,pairsinweek);
                        break;
                    case 2:
                        showTimetable(currentUser);
                        break;
                    case 3:
                        userMenu();
                        break;
                    case 0:
                        System.out.println("Вы успешно вышли из системы\n");
                        Lab3.outputMenu();
                        break;
                    default:
                        System.out.println("Введена недопустимая команда!");
                }
            }while (command!=0);
        }
    }
}
