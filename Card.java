
/**
 * Esta clase sirve para instanciar objetos carta, con las mismas propiedades que una carta normal de poker.
 * 
 * @author Francisco Fernando Gaitán Pérez
 */

public class Card {
    private final int rank;
    private final int suit;
    public static final String[] suits = {"Clubs", "Diamonds", "Hearts", "Spades"};
    public static final String[] ranks = {null, "Ace", "2", "3", "4", "5", "6",
           "7", "8", "9", "10", "Jack", "Queen", "King"};

    public Card(int rank, int suit) {
        this.rank = rank;
        this.suit = suit;
    }

    public int getRank() {
        return this.rank;
    }
    public int getSuit() {
        return this.suit;
    }
    
    public String toString() {
        String s = ranks[this.rank] + " of " + suits[this.suit];
        return s;
    }

    /**
     * equals
     * Sirve para ver si ina carta es igual a otra
     * 
     * @param that El objeto carta con el que queremos comparar la carta actual
     * @return Devuelve un booleano, true si son iguales, false si no
     */
    public boolean equals(Card that) {
        return this.rank == that.rank
            && this.suit == that.suit;
    }

    /**
     * Ejemplo ejemplo
     * @param that la otra carta
     * @return Si es igual 0, menor -1 mayor 1
     */
    public int compareTo(Card that) {
        if (this.suit < that.suit) {
            return -1;
        }
        if (this.suit > that.suit) {
            return 1;
        }
        if (this.rank == 1 && that.rank != 1) {
            return 1;
        }
        if (this.rank != 1 && that.rank == 1) {
            return -1;
        }
        if (this.rank < that.rank) {
            return -1;
        }
        if (this.rank > that.rank) {
            return 1;
        }
        return 0;
    }

    /**
     * bla bla
     */

    public static void main(String[] args) {
        Card carta = new Card(1, 1);
        Card cartaDos = new Card(1, 2);
        System.out.println(carta.compareTo(cartaDos));
    }
}