
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Iterator;
import java.util.List;

import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import com.dermalog.common.DermalogImage;
import com.dermalog.common.exception.DermalogException;
import com.dermalog.demo.common.DemoUtility;
import com.dermalog.demo.common.PicturePanel;
import com.dermalog.demo.common.VersionDialog;
import com.dermalog.demo.common.VersionDialog.LabeledVersion;
import com.dermalog.imaging.capturing.Device;
import com.dermalog.imaging.capturing.DeviceManager;
import com.dermalog.imaging.capturing.OnDetectEventData;
import com.dermalog.imaging.capturing.OnDetectListenerEx;
import com.dermalog.imaging.capturing.OnErrorListener;
import com.dermalog.imaging.capturing.OnImageEventData;
import com.dermalog.imaging.capturing.OnImageListenerEx;
import com.dermalog.imaging.capturing.cwrap.vc.DeviceInfo;
import com.dermalog.imaging.capturing.cwrap.vcdefs.LIFENESSINFO;
import com.dermalog.imaging.capturing.exception.DeviceException;
import com.dermalog.imaging.capturing.exception.ListenerException;
import com.dermalog.imaging.capturing.exception.PropertyException;
import com.dermalog.imaging.capturing.valuetype.CaptureMode;
import com.dermalog.imaging.capturing.valuetype.DeviceIdentity;
import com.dermalog.imaging.capturing.valuetype.FrameInfoTypes;
import com.dermalog.imaging.capturing.valuetype.PropertyType;
import com.dermalog.imaging.capturing.valuetype.lf10.Lf10Led;
import com.dermalog.imaging.capturing.valuetype.lf10.Lf10LedColor;
import javax.swing.WindowConstants;
import java.util.Random;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.IOException;
import java.awt.image.BufferedImage;
import javax.imageio.ImageIO;
import com.dermalog.afis.imagecontainer.*;

import java.util.Base64;
import java.io.FileWriter;   // Import the FileWriter class
import java.awt.image.RenderedImage;
import java.awt.image.DataBufferByte;
import javax.imageio.ImageIO;
import java.awt.*;
import javax.swing.*;
import java.io.ByteArrayOutputStream;
import org.apache.commons.io.IOUtils;

/**
 * Demo application for the dermalog.imaging.capturing API.
 * 
 * @version $Revision: 1590 $
 * @author DERMALOG Identification Systems GmbH
 */
public class VideoCaptureDemo extends JFrame  {

	/** long <code>serialVersionUID</code>. */
	private static final long serialVersionUID = 1L;

	private static final Color MEDIUM_SEA_GREEN = new Color(60, 179, 113);
	private static final Color FIREBRICK = new Color(178, 34, 34);

	private static final int MAX_IMAGE_HEIGHT = 320;
	private static final int MAX_IMAGE_WIDTH = 480;
	private static final Dimension MAX_IMAGE_DIMENSION = new Dimension(MAX_IMAGE_WIDTH, MAX_IMAGE_HEIGHT);

	//private static final String ABOUT_COMMAND = "About";
	//rivate static final String PROPERTIES_COMMAND = "Properties";
	//private static final String SELECT_CAPTURE_MODE_COMMAND = "Capture modes";
	//private static final String SELECT_DEVICE_COMMAND = "Select Device";
	//private static final String CLOSE_COMMAND = "Exit";
	//private static final String STOP_COMMAND = "Stop";
	//private static final String START_COMMAND = "Start";
	//private static final String FREEZE_COMMAND = "Freeze";

	//private static final int COUNT_OF_IMAGES_BEFORE_GC = 10;

//	private static final DecimalFormat TWO_FRACTS = new DecimalFormat("#.##");

	private Device device;

	private DEVICE_STATE deviceState = DEVICE_STATE.NOT_LOADED;

	private boolean fakeDetection = false;

//	private JMenuItem startMenuItem;
//	private JMenuItem stopMenuItem;
//	private JMenuItem freezeMenuItem;
//	private JMenu selectCaptureModeMenuItem;
//	private JMenuItem propertiesMenuItem;
//	private JMenu selectDeviceMenuItem;
//	private List<JRadioButtonMenuItem> deviceMenuItems = new ArrayList<JRadioButtonMenuItem>();
//	private List<JRadioButtonMenuItem> captureModeItems = new ArrayList<JRadioButtonMenuItem>();
//	private JLabel leftPicture;
//	private JLabel rightPicture;
//	private JLabel deviceStatusLabel;
//	private JLabel contaminationLabel;
//	private JLabel livenessLabel;

	//final ButtonGroup deviceGroup = new ButtonGroup();

	private int readImages = 0;
private WindowAdapter windowAdapter = null;
	private DermalogImage previewImage = null;

//	private JButton contaminationButton;



	/**
	 * inits the event listeners for LF10.
	 */
	private void initDeviceEvents() {
		device.addOnImageListenerEx(new OnImageListenerEx() {

			public void onImage(OnImageEventData eventData)
					throws ListenerException {
				try {
					previewImage = eventData.getDermalogImage();
					//updateLeftPicture(previewImage);
				} catch (Exception exp) {
					//JOptionPane.showMessageDialog(getFrame(), exp.getMessage(),
					//		"Device error", JOptionPane.ERROR_MESSAGE);
				}
			}
		});

		device.addOnDetectListenerEx(new OnDetectListenerEx() {

			public void onDetect(OnDetectEventData eventData) {
				try {
					ProcessImage(eventData.getDermalogImage());
				} catch (Exception exp) {
					//JOptionPane.showMessageDialog(getFrame(), exp.getMessage(),
							//"Device error", JOptionPane.ERROR_MESSAGE);
				}

			}
		});

		device.addOnErrorListener(new OnErrorListener() {

			public void onError(Device device, int nChannel,
					String errorMessage, Throwable exp) {
				deviceState = DEVICE_STATE.ERROR;

			}
		});
	}

	private void ProcessImage(DermalogImage image) throws DermalogException {
		updateRightPicture(image);

	}

	/**
	 * Opens the demo window.
	 */
	public void showDemo() {
		try {
			UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
		} catch (Exception exception) {
			// use default look and feel
		}
		//addWindowListener(new CloseWindowAdapter());

		//setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
	    pack();
		initDeviceMenuItems();
		//setVisible(true);



	}

		     public void pullThePlug() {
       SwingUtilities.invokeLater(new Runnable()
            {
                public void run()
                {
                  unloadDeviceAndClose();
                }
            });
 				//		this.dispatchEvent(new WindowEvent(this, WindowEvent.WINDOW_CLOSING));
                	//	unloadDeviceAndClose();
        }
	/**
	 * inits the device menu items.
	 * 
	 * @throws DermalogException
	 */
	private void initDeviceMenuItems() {
		try {
			DeviceIdentity[] identities = DeviceManager.getDeviceIdentities();
		
			int dev_counter=0;
			for (DeviceIdentity deviceId : identities) {
				try {
					
					DeviceInfo[] information = DeviceManager.getAttachedDevices(deviceId);
					if(dev_counter==0){
					//	loadDevice(deviceIdStart,(information[0].getIndex()));
					if (information.length == 0)
						continue;
					for (int i = 0; i < information.length; i++) {
						
						if(i==0){
						int deviceIndex = Integer.parseInt(String.valueOf(information[i].getIndex()));	
						loadDevice(deviceId,deviceIndex);

						}
					}


						}
					//deviceGroup.add(deviceMenu);
				} catch (DermalogException e) {

				}
				dev_counter++;
			}
			
			//System.out.println("Init Start");
			 CaptureMode captureMode = CaptureMode.valueOf("PREVIEW_IMAGE_AUTO_DETECT");
			device.setCaptureMode(captureMode);
			//startDevice()
		switch (deviceState) {
		case ERROR:
				stopDevice();
		case LOADED:
				stopDevice();
				startDevice();
		case STOPPED:
				startDevice();
			break;
		case STARTED:
		case FREEZE:
		case NOT_LOADED:
				startDevice();

		}




		} catch (DermalogException e) {
		//	e.printStackTrace();
		//System.out.println("Error Init Device");
		}catch (Exception de) {
			//JOptionPane.showMessageDialog(this, de.getMessage(), "Exception",JOptionPane.ERROR_MESSAGE);
		}

	}

	/**
	 * Sets the image of the demo.
	 * 
	 * @param image
	 *            image of the demo.
	 */
	private void updateRightPicture(DermalogImage image) {
		//rightPicture.removeAll();

	 Image sizedImage = DemoUtility.resizeImage(image.getImage(), new Dimension(MAX_IMAGE_WIDTH, MAX_IMAGE_HEIGHT));
		//ImageIcon sImg=new ImageIcon(sizedImage);
	//	rightPicture.setIcon(sImg);
				// This code ensures that all the pixels in the image are loaded
		sizedImage = new ImageIcon(sizedImage).getImage();
	   // Image tmp = sizedImage.getScaledInstance(318, 394, Image.SCALE_SMOOTH);
		String filenames="";
		//image = new ImageIcon(image).getImage();
 		Image tmp = sizedImage.getScaledInstance(320, 480, Image.SCALE_SMOOTH);
 	  int lengthOfRandomString = 6;
      Random rand = new Random();
      String alphaNumericCharacters = "abcdefghijklmnopqrstuvwxyz" + "ABCDEFGHIJLMNOPQRSTUVWXYZ"+ "1234567890";
 
      // Use StringBuilder in place of String to avoid unnecessary object formation
      StringBuilder result = new StringBuilder();
      
      for (int i =0; i< lengthOfRandomString ; i++) {
           result.append(alphaNumericCharacters.charAt(rand.nextInt(alphaNumericCharacters.length())));
      }
	// Get the icon
	//Icon ico = rightPicture.getIcon();
	// Create a buffered image
	//BufferedImage bimg = new BufferedImage(sizedImage.getWidth(null), sizedImage.getHeight(null),BufferedImage.TYPE_BYTE_GRAY);
     BufferedImage bimg = new BufferedImage(tmp.getWidth(null), tmp.getHeight(null),BufferedImage.TYPE_BYTE_GRAY);
	// Create the graphics context


	Graphics g = bimg.createGraphics();
	// Now paint the icon
	//g.setColor(Color.DARK_GRAY);
	//	gfx.drawRect(0, 0, this.getWidth()-1, this.getHeight()-1);
	g.drawImage(tmp, 0, 0, null);
	//ico.paintIcon(null, g, 0, 0);
	g.dispose();
	filenames=result.toString();
	//filenames="z";''
	 RenderedImage rendImage = bimg;

	RawImage rawImage =  null;
	Decoder dicDecoder = null;
	Encoder dicEncoder = null;

	try {

	ByteArrayOutputStream baos = new ByteArrayOutputStream();
	ImageIO.write(rendImage, "bmp", baos);
	byte[] bytes = baos.toByteArray();
	dicDecoder = new Decoder();
	rawImage= dicDecoder.Decode(bytes);
	rawImage.setDpiX(500);
	rawImage.setDpiY(500);
	dicEncoder = new EncoderBmp();

	byte[] imgData = dicEncoder.Encode(rawImage);
	DemoUtility.writeFile("read/"+filenames+".bmp", imgData);
	}catch (Throwable ex) {
			//ex.printStackTrace();
			//System.exit(1);
		} finally {
			try {
				// close native resources
				rawImage.close();
				dicDecoder.close();
				dicEncoder.close();
				//pullThePlug();
			} catch (DICException e) {
	
			}

		}
	//ImageIO.write(rendImage, "bmp", new File("read/"+filenames+".bmp"));		

		byte[] buffer = null;
		try {
			
			buffer = ReadFile(new File("read/"+filenames+".bmp"));
		} catch (IOException e) {
		//	e.printStackTrace();
		//	System.exit(1);
		}

		Decoder decoder = null;
		Encoder encoder = null;
		RawImage inputImage = null;
	try {



				// create decoder instance
			decoder = new Decoder();
			//detect format
			ImageFormat inputFormat = decoder.DetectFormat(buffer);
			// decode input image into RawImage instance
			inputImage = decoder.Decode(buffer);
			encoder = new EncoderWsq();
			byte[] outBuffer = encoder.Encode(inputImage);
		
			WriteFile(filenames+".wsq", outBuffer,filenames+".bmp");
		}catch (Throwable ex) {
			//ex.printStackTrace();
			//System.exit(1);
		} finally {
			try {
				// close native resources
				inputImage.close();
				encoder.close();
				decoder.close();
				pullThePlug();
			} catch (DICException e) {
	
			}

		}




	

	}

	

	private void unloadDeviceAndClose() {
		try {
		
				device.stop();
				device.dispose();
			//	System.out.println("Code Stop");
			
		} catch (DermalogException e) {
			//System.out.println("error device");
			// ignore, only closing
		}finally {

		//setVisible(false);
		//getContentPane().removeAll();
		// CHECKSTYLE_OFF
		// stop the virtual machine:
		System.exit(this.EXIT_ON_CLOSE);
		//throw new YourException();
//Runtime.getRuntime().exit(0);
		 return;
	}

	}
	/**
	 * Loads the device.
	 * 
	 * @param deviceId
	 *            id of the device.
	 * @param deviceIndex
	 *            index of the device (if there should be more than one device
	 *            of the same type)
	 * @throws DeviceException
	 */
	private void loadDevice(DeviceIdentity deviceId, int deviceIndex)
			throws DermalogException {

		if (device != null)
			device.dispose();

		device = DeviceManager.getDevice(deviceId, deviceIndex);
		deviceState = DEVICE_STATE.LOADED;
		initDeviceEvents();
		//initCaptureModesMenu();

	}

	/**
	 * stops the device.
	 * 
	 * @throws DeviceException
	 */
	private void stopDevice() throws DermalogException {
		device.stop();

		deviceState = DEVICE_STATE.STOPPED;
	//	this.deviceStatusLabel.setText("Device " + device.getDeviceId()
		//	+ " stopped.");
	//	deviceStatusLabel.setForeground(MEDIUM_SEA_GREEN);
	}

	/**
	 * freeze / unfreeze the device.
	 * 
	 * @throws DeviceException
	 */
	private void freezeDevice() throws DermalogException {
	//	deviceStatusLabel.setForeground(MEDIUM_SEA_GREEN);

		if (device.isFreeze()) {
			device.setFreeze(false);
			deviceState = DEVICE_STATE.STARTED;
		//	this.deviceStatusLabel.setText("Device " + device.getDeviceId()
				//	+ " started.");
		} else {
			device.setFreeze(true);
			deviceState = DEVICE_STATE.FREEZE;
			//this.deviceStatusLabel.setText("Device " + device.getDeviceId()
				//	+ " frozen.");
		}

	}

	/**
	 * starts the device.
	 * 
	 * @throws DeviceException
	 */
	private void startDevice() throws DermalogException {
		device.start();
		deviceState = DEVICE_STATE.STARTED;

		try {
			List<PropertyType> props = Arrays.asList(device.getAvailableProperties());
			if (props.contains(PropertyType.FG_LEDS)) {
				// LF10
				device.setProperty(PropertyType.FG_LEDS,
						Lf10Led.STATUS.getValue()
								+ Lf10LedColor.GREEN.getValue());
			} else if (props.contains(PropertyType.FG_GREEN_LED)) {
				// ZF1/ZF2
				device.setProperty(PropertyType.FG_GREEN_LED, 1);
				device.setProperty(PropertyType.FG_RED_LED, 0);
			}
		} catch (PropertyException exception) {
			//System.out.println("Error start device");
			} 

	}


	/**
	 * state of the device.
	 * 
	 * @version $Revision: 1590 $
	 * @author DERMALOG Identification Systems GmbH
	 */
	private enum DEVICE_STATE {
		NOT_LOADED, LOADED, STARTED, STOPPED, ERROR, FREEZE
	}

	
	public static byte[] ReadFile(File file) throws IOException {
	    byte[] buffer = new byte[(int) file.length()];
	    InputStream ios = null;
	    try {


	        ios = new FileInputStream(file);
	        if (ios.read(buffer) == -1) {
	        //    throw new IOException(
	                   // "EOF reached while trying to read the whole file");
	        }

	    } finally {
	        try {
	            if (ios != null)
	                ios.close();
	        } catch (IOException e) {
	        }
	    }
	    return buffer;
	}

	private static void WriteFile(String outputFile, byte[] outBuffer,String oldFileName) {
		FileOutputStream stream = null;
		try {
			DemoUtility.writeFile("write/"+outputFile, outBuffer);
			//stream = new FileOutputStream("write/"+outputFile);
		    //stream.write(outBuffer);
		   // Base64.Encoder simpleEncoder = Base64.getEncoder();
		   // File originalFile = new File(outputFile);
        String encodedBase64 = null;
		 //   byte[] bytes = new byte[(int)originalFile.length()];
          	// fileInputStreamReader.read(bytes);
        InputStream iSteamReader = new FileInputStream("write/"+outputFile);
        byte[] imageBytes = IOUtils.toByteArray(iSteamReader);
        encodedBase64 = Base64.getEncoder().encodeToString(imageBytes);
           // encodedBase64 =simpleEncoder.encodeToString(bytes);
           System.out.println(oldFileName);
           //System.out.println(encodedBase64);
            System.out.println(encodedBase64);

  		 FileWriter myWriter = new FileWriter("write/filename.txt");
      	myWriter.write(encodedBase64);
      	myWriter.close();
    
		} catch (IOException e) {
			e.printStackTrace();
		} finally {
		    try {
				stream.close();
			} catch (IOException e) {
				e.printStackTrace();
			}
		}

	}

		/*
	 * Returns this frame.
	 * 
	 * @return this frame.
	 */
	private JFrame getFrame() {
		return this;
	}

	/**
	 * To call {@link Device#dispose()} when window closes.
	 * 
	 * @version $Revision: 1590 $
	 * @author DERMALOG Identification Systems GmbH
	 
	class CloseWindowAdapter extends WindowAdapter {
		@Override
		public void windowClosing(WindowEvent event) {
			unloadDeviceAndClose();
		}
	}*/
	/**
	 * main method.
	 * 
	 * @param args
	 *            arguments.
	 */
	public static void main(String[] args) {
		new VideoCaptureDemo().showDemo();
	//	new VideoCaptureDemo().startDevice();

	}



}
