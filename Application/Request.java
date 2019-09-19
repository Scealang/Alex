package Application;

// Класс "заявка"
public class Request
{
    // Поля класса "заявка"
    User requester; // Информация о человеке, оставившем заявку
    String discipline; // Название дисциплины
    int group; // Номер группы
    int pairsinweek; // Количество пар в неделю

    // Конструктор с параметрами класса "заявка"
    public Request(User requester,String discipline, int group, int pairsinweek)
    {
        this.requester=requester;
        this.discipline = discipline;
        this.group = group;
        this. pairsinweek = pairsinweek;
    }

    // Метод получения информации о человеке, оставившем заявку
    public User getRequester()
    {
        return requester;
    }

    // Метод получения названия дисциплины
    public String getDiscipline()
    {
        return discipline;
    }

    // Метод получения номера группы
    public int getGroup()
    {
        return group;
    }

    // Метод получения количества пар в неделю
    public int getPairsinweek()
    {
       return pairsinweek;
    }
}
