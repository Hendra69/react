import React, { useEffect, useState } from "react";
import {
  Button,
  Col,
  DatePicker,
  Form,
  Input,
  Popover,
  Radio,
  Row,
  Select,
  Space,
  Table,
} from "antd";
import { Delete } from "react-iconly";
import _ from "lodash";

export const ContractForm = ({
  customers,
  deliveries,
  form,
  initialValues,
  name,
  onFinish,
  tanks,
}) => {
  const [tankDropdowns, setTankDropdowns] = useState([]);
  const [deliveryDropdowns, setDeliveryDropdowns] = useState([]);
  const [deliveryVisibility, setDeliveryVisibility] = useState(false);
  const [isCustomerRS, setIsCustomerRS] = useState(false);

  useEffect(() => {
    setTankDropdowns(
      tanks.map((item) => ({
        label: item.serial_number + " - " + item.category_name,
        value: item.id,
      }))
    );
  }, [tanks]);

  const [dataSource, setDataSource] = useState([]);

  const columns = [
    {
      title: "No Tabung",
      dataIndex: "serial_number",
      key: "serial_number",
    },
    {
      title: "Kategori",
      dataIndex: "category_name",
      key: "category_name",
    },
    {
      title: "Jenis Kontrak",
      dataIndex: "contract_type",
      key: "contract_type",
      render: (text, record) => (
        <Radio.Group
          onChange={handleChangeContractType(record.id)}
          options={[
            {
              label: "Deposit",
              value: "Deposit",
            },
            {
              label: "Sewa Biasa",
              value: "Sewa Biasa",
            },
            {
              label: "Rumah Sakit",
              value: "Rumah Sakit",
            },
          ]}
          defaultValue={record.contract_type}
        />
      ),
    },
    {
      title: "Aksi",
      key: "actions",
      render: (text, record) => (
        <Space size="middle">
          <Popover content="Hapus">
            <Button
              type="primary"
              ghost
              danger
              icon={
                <Delete size="medium" set="curved" className="remix-icon" />
              }
              onClick={handleClickDelete(record.id)}
            />
          </Popover>
        </Space>
      ),
    },
  ];

  const handleChangeContractType = (id) => (value) => {
    setDataSource((prevData) =>
      prevData.map((data) =>
        data.id === id ? { ...data, contract_type: value } : data
      )
    );
  };

  const handleClickDelete = (id) => () => {
    setDataSource((prevData) => prevData.filter((data) => data.id !== id));
  };

  const handleValuesChange = (changedValues, allValues) => {
    if (changedValues.tanks_id) {
      const updatedTanksId = changedValues.tanks_id;

      const currentTanksId = _.map(dataSource, "id");

      // delete old
      const currentData = dataSource.filter((data) =>
        updatedTanksId.includes(data.id)
      );

      // add new
      const newTanksId = updatedTanksId.filter(
        (id) => !currentTanksId.includes(id)
      );
      const newData = tanks
        .filter((item) => newTanksId.includes(item.id))
        .map((data) => ({
          ...data,
          contract_type: isCustomerRS ? "Rumah Sakit" : "Deposit",
        }));

      setDataSource([...currentData, ...newData]);
    }

    if (changedValues.customer_id) {
      const customer = customers.find(
        (customer) => customer.id === changedValues.customer_id
      );

      form.setFieldsValue({ delivery_id: null });
      if (customer.type === "RS") {
        setDeliveryVisibility(true);
        setDeliveryDropdowns(
          deliveries
            .filter((delivery) => delivery.customer.customer_id === customer.id)
            .map((delivery) => ({
              label: delivery.date + " (" + delivery.type + ")",
              value: delivery.id,
            }))
        );
        setIsCustomerRS(true);
      } else {
        setDeliveryVisibility(false);
        setDeliveryDropdowns([]);
        setIsCustomerRS(false);
      }
    }
  };

  useEffect(() => {
    form.setFieldsValue({
      tanks: dataSource,
      tanks_id: dataSource.map((data) => {
        if (data.contract_id) {
          return data.tank_id;
        }
        return data.id;
      }),
    });
  }, [dataSource]);

  useEffect(() => {
    if (initialValues) {
      setDataSource(initialValues.tanks);

      form.setFieldsValue({
        tanks_id: _.map(initialValues.tanks, "tank_id"),
        customer_id: initialValues.customer.customer_id,
      });
    }
  }, [initialValues]);

  return (
    <Form
      layout="vertical"
      form={form}
      name={name}
      initialValues={initialValues}
      onFinish={onFinish}
      onValuesChange={handleValuesChange}
    >
      <Row gutter={[32, 0]}>
        <Col span={8}>
          <Form.Item
            name="customer_id"
            label="Pelanggan"
            rules={[{ required: true, message: "Pelanggan dibutuhkan" }]}
          >
            <Select
              options={customers.map((customer) => ({
                label: customer.name + " - " + customer.type,
                value: customer.id,
              }))}
              showSearch
              optionFilterProp="label"
              optionLabelProp="label"
            />
          </Form.Item>
        </Col>

        <Col span={8}>
          <Form.Item
            name="from"
            label="Dari Tanggal"
            rules={[{ required: true, message: "Dari tanggal dibutuhkan" }]}
          >
            <DatePicker
              style={{ width: "100%" }}
              format={["DD/MM/YYYY", "YYYY-MM-DD"]}
            />
          </Form.Item>
        </Col>

        <Col span={8}>
          <Form.Item
            name="to"
            label="Sampai Tanggal"
            rules={[{ required: true, message: "Sampai tanggal dibutuhkan" }]}
          >
            <DatePicker
              style={{ width: "100%" }}
              format={["DD/MM/YYYY", "YYYY-MM-DD"]}
            />
          </Form.Item>
        </Col>

        <Col span={24}>
          <Form.Item
            name="tanks_id"
            label="Tabung"
            rules={[{ required: true, message: "Tabung dibutuhkan" }]}
          >
            <Select
              mode="multiple"
              options={tankDropdowns}
              optionFilterProp="label"
              optionLabelProp="label"
              showSearch
            />
          </Form.Item>

          <Form.Item name="tanks" hidden noStyle>
            <Input />
          </Form.Item>

          <Table
            columns={columns}
            dataSource={dataSource}
            rowKey="id"
            pagination={false}
            className="da-mb-32"
            bordered={true}
          />
        </Col>

        <Col span={8}>
          <Form.Item
            name="delivery_id"
            label="Surat Jalan"
            rules={
              deliveryVisibility && [
                { required: true, message: "Surat jalan dibutuhkan" },
              ]
            }
            hidden={!deliveryVisibility}
          >
            <Select
              options={deliveryDropdowns}
              showSearch
              optionFilterProp="label"
              optionLabelProp="label"
            />
          </Form.Item>
        </Col>
      </Row>

      <Form.Item>
        <Button type="primary" htmlType="submit">
          Submit
        </Button>
      </Form.Item>
    </Form>
  );
};
