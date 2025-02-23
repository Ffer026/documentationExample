import java.awt.Canvas;
import java.awt.Color;
import java.awt.Graphics;
import java.awt.Image;

import javax.swing.ImageIcon;
import javax.swing.JFrame;

public class CardTable extends Canvas {

    private Image[][] images;
    private int cardWidth, cardHeight;

    /**
     * Creates a CardTable.
     * cardset is the name of the folder that contains the card images.
     */
    public CardTable(String cardset) {
        setBackground(new Color(0x088A4B));

        // create a 2-D array of card images
        images = new Image[14][4];
        String suits = "cdhs";

        for (int suit = 0; suit <= 3; suit++) {
            char c = suits.charAt(suit);

            for (int rank = 0; rank <= 13; rank++) {
                if (rank != 0) {
                    String s = String.format("%s/%02d%c.gif",
                                         cardset, rank, c);
                    images[rank][suit] = new ImageIcon(s).getImage();
                } else  if (suit == 0) {
                    images[rank][suit] = new ImageIcon("cardset-oxymoron/back192.gif").getImage();
                } else  if (suit == 1) {
                    images[rank][suit] = new ImageIcon("cardset-oxymoron/shade.gif").getImage();
                }
            }
        }

        // get the width and height of the cards and set the size of
        // the frame accordingly
        cardWidth = images[1][1].getWidth(null);
        cardHeight = images[1][1].getHeight(null);

        // set the size temporarily to get the insets
        setTableSize(8.2, 3);
    }

    /**
     * Sets the table size.
     * x and y are in units of card width/height.
     */
    public void setTableSize(double x, double y) {
        setSize((int) (x * cardWidth),
                (int) (y * cardHeight));
    }

    /**
     * Draws a card at the given coordinates.
     * x and y are in units of card width/height.
     */
    public void drawCard(Graphics g, int rank, int suit, double x, double y) {
        Image image = images[rank][suit];
        g.drawImage(image,
                    (int) (x * cardWidth * 1.1),
                    (int) (y * cardHeight * 1.1),
                    null);
    }
    
    public void paint(Graphics g) {
        Image image = images[0][0];
        int x = 10, y = 10, cardWidth, cardHeight;
        cardWidth = image.getWidth(null);
        cardHeight = image.getHeight(null);
        g.drawImage(image, x, y, null);
        x += cardWidth + 10;

        image = images[4][3];
        g.drawImage(image, x, y, null);
        x += cardWidth*2 + 20;

        for (int i = 0; i < 4; i++) {
            image = images[0][1];
            g.drawImage(image, x, y, null);
            x += cardWidth + 10;
        }
        x = 10;
        y += cardHeight + 10;

        image = images[12][2];
        g.drawImage(image, x, y, null);
        x += cardWidth + 10;
        for (int i = 0; i < 6; i++) {
            image = images[0][0];
            g.drawImage(image, x, y, null);
            x += cardWidth + 10;
        }
        x = 10 * 2 + cardWidth;
        y += 10;

        image = images[13][1];
        g.drawImage(image, x, y, null);
        x += cardWidth + 10;
        for (int i = 0; i < 5; i++) {
            image = images[0][0];
            g.drawImage(image, x, y, null);
            x += cardWidth + 10;
        }
        x = 10 * 3 + cardWidth * 2;
        y += 10;

        image = images[6][0];
        g.drawImage(image, x, y, null);
        x += cardWidth + 10;
        for (int i = 0; i < 4; i++) {
            image = images[0][0];
            g.drawImage(image, x, y, null);
            x += cardWidth + 10;
        }
        x = 10 * 4 + cardWidth * 3;
        y += 10;

        image = images[12][3];
        g.drawImage(image, x, y, null);
        x += cardWidth + 10;
        for (int i = 0; i < 3; i++) {
            image = images[0][0];
            g.drawImage(image, x, y, null);
            x += cardWidth + 10;
        }
        x = 10 * 5 + cardWidth * 4;
        y += 10;

        image = images[8][1];
        g.drawImage(image, x, y, null);
        x += cardWidth + 10;
        for (int i = 0; i < 2; i++) {
            image = images[0][0];
            g.drawImage(image, x, y, null);
            x += cardWidth + 10;
        }
        x = 10 * 6 + cardWidth * 5;
        y += 10;

        image = images[8][3];
        g.drawImage(image, x, y, null);
        x += cardWidth + 10;
        for (int i = 0; i < 1; i++) {
            image = images[0][0];
            g.drawImage(image, x, y, null);
            x += cardWidth + 10;
        }
        x = 10 * 7 + cardWidth * 6;
        y += 10;

        image = images[7][3];
        g.drawImage(image, x, y, null);
    }

    public static void main(String[] args) {
        // make the frame
        JFrame frame = new JFrame("Card Table");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        // add the CardTable
        String cardset = "cardset-oxymoron";
        Canvas canvas = new CardTable(cardset);
        frame.getContentPane().add(canvas);

        // show the frame
        frame.pack();
        frame.setVisible(true);
    }

}