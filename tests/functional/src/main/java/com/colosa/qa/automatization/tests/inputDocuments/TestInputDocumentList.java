package com.colosa.qa.automatization.tests.inputDocuments;

import org.junit.Assert;
import org.junit.After;
import org.junit.AfterClass;
import org.junit.Test;

import com.colosa.qa.automatization.pages.*;
import com.colosa.qa.automatization.common.*;

import java.io.FileNotFoundException;
import java.io.IOException;

public class TestInputDocumentList{

	@Test
	public void createInputDocument() throws FileNotFoundException, IOException, Exception{

		Pages.Login().gotoUrl();
		Pages.Login().loginUser("admin", "admin", "workflow");
		Pages.Main().goDesigner();
		Pages.ProcessList().openProcess("Test InputDoc List");
		Pages.ProcessDesigner().openInputDocuments();
		Pages.InputDocumentList().createInputDoc("Prueba "+new java.util.Date().toString(), "Digital", "Prueba 3", "YES", "@#PROCESS", "_Document3_@#TASK");
		//Pages.InputDocumentList().closePopup();

		Pages.InputDocProcess().switchToDefault();
		Pages.Main().logout();
	}

    @After
    public void cleanup(){
        Browser.close();
    }


}