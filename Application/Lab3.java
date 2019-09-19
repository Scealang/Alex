package Application;

// Импорт классов
import java.util.Scanner;

// Основной класс
public class Lab3
{
    // Метод вывода меню программы
    public static void outputMenu()
    {
        System.out.println("Меню программы:");
        System.out.println("1 Войти");
        System.out.println("2 Зарегистрироваться");
        System.out.println("3 Повторный вывод меню");
        System.out.println("0 Выход из программы");
    }

    // Метод регистрации пользователя
    public static TimetableSystem registerUser(TimetableSystem schedue)
    {
        Scanner input = new Scanner(System.in);
        System.out.println("Введите ваше имя");
        String name = input.nextLine();
        System.out.println("Введите ваш логин");
        String login = input.nextLine();
        System.out.println("Введите ваш пароль");
        String password = input.nextLine();
        schedue.addUser(name,login,password);
        return schedue;
    }

    //Главный метод
    public static void main(String[] args)
    {
        TimetableSystem schedue = new TimetableSystem();
        int command;
        outputMenu();
        Scanner input = new Scanner(System.in);
            do
            {
                System.out.println("\nВведите команду");
                command = input.nextInt();
                switch (command)
                {
                    case 1:
                        schedue.loginSystem();
                        break;
                    case 2:
                        schedue = registerUser(schedue);
                        break;
                    case 3:
                        outputMenu();
                        break;
                    case 0:
                        System.out.println("Программа завершена");
                        break;
                    default:
                        System.out.println("Введена недопустимая команда!");
                }
            }while (command!=0);
    }
}
