import java.util.ArrayList;

class Array {
    private int[] item;
    private int count; 

    public Array(int length) {
        item = new int[length];
    }

    public void print() {
        for (int i = 0; i < count; i++)
            System.out.println(item[i]);
    }
    public void insert(int value){
        if(count == item.length){
            int[] newItem = new int[count * 2];
            for(int i = 0; i < count; i++){
                newItem[i] = item[i];
            }
            item = newItem;
        }
        item[count] = value;
        count++;
    }

    public void remove(int index) {
        if(index < 0 || index >= count)
            throw new IllegalArgumentException();

        for(int i = index; i < count; i++)
            item[i] = item[i + 1];

        count--;
    }

}

class z {
    public static void main(String[] args) {
        Array number = new Array(3);
        number.insert(33);
        number.insert(233);
        number.insert(33);
        number.insert(233);
        number.remove(2);
        number.print();

        ArrayList<Integer> n = new ArrayList<>();
        n.add(131);
        System.out.println(n);
    }
} 